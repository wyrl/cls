<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="contact-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="contact-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="contact">Contact Number</label>
                        <input required type="text" name="contact" class="form-control" id="contact" placeholder="Enter a contact number">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input required type="text" name="email" class="form-control" id="email" placeholder="Enter a email">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input required type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter a first name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Lastname</label>
                                <input required type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter a last name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <img style="display:none" class="loading" width="50" height="50" src="<?= base_url('assets/icon/loading.gif') ?>" />
                    <button type="submit" class="btn btn-primary btn-add-save">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure do you want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-yes">Yes</button>
                <button type="button" class="btn btn-secondary btn-no" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<main id="home-page">
    <div class="container">

        <form action="<?= site_url() ?>" class="form-inline search-form mt-4">
            <input class="form-control search-input" name="s" value="<?= $search ?>" type="text" placeholder="Search"><button type="submit" class="btn btn-primary">Go</button>
            <input type="hidden" name="page" value="<?= $current_page ?>">
        </form>
        <div class="btn-actions my-4">
            <button class="btn btn-primary btn-add" data-toggle="modal" data-target="#contact-modal">Add</button>
        </div>
        <table class="table contact-table">
            <thead class="thead-dark">
                <tr>
                    <th>Contact Number</th>
                    <th class="h-fullname">Fullname</th>
                    <th class="h-email">Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr id="tr-template" style="display: none;">
                    <td class="contact"></td>
                    <td class="fullname"></td>
                    <td class="email"></td>
                    <td class="action-buttons"><button class="btn-edit"><img src="<?= base_url('assets/img/pencil.png') ?>" width="24"></button> <button class="btn-delete"><img src="<?= base_url('assets/img/delete.png') ?>" width="24"></button></td>
                </tr>

                <?php foreach ($contacts as $contact) : ?>
                    <tr data-id="<?= $contact->id ?>">
                        <td class="contact"><?= $contact->contact_number ?></td>
                        <td class="fullname"><?= $contact->firstname . " " . $contact->lastname; ?></td>
                        <td class="email"><?= $contact->email ?></td>
                        <td class="action-buttons"><button class="btn-edit"><img src="<?= base_url('assets/img/pencil.png') ?>" width="24"></button> <button class="btn-delete"><img src="<?= base_url('assets/img/delete.png') ?>" width="24"></button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($current_page == 1) echo 'disabled' ?>">
                    <a class="page-link" href="<?= site_url("?page=1&s=$search") ?>" tabindex="-1">Previous</a>
                </li>

                <?php for ($i = 1; $i <= $page_count; $i++) : ?>
                    <li class="page-item <?php if ($current_page == $i) echo 'disabled' ?>"><a class="page-link" href="<?= site_url("?page=$i&s=$search") ?>"><?= $i ?></a></li>
                <?php endfor; ?>

                <li class="page-item <?php if ($current_page == $page_count) echo 'disabled' ?>">
                    <a class="page-link" href="<?= site_url("?page=$page_count&s=$search") ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</main>

<script>
    var $contact_form = $("#contact-form");
    var $contact_table = $('.contact-table');
    var $tr_template = $('#tr-template');
    var $contact_modal = $('#contact-modal');
    var $btn_add_save = $('.btn-add-save');
    var current_contact = [];
    var $current_tr = undefined;

    var contacts_json = <?= json_encode($contacts); ?>;

    var onEdit = function() {

        var $tr = $(this).parent().parent();
        $current_tr = $tr;
        var id = $tr.data("id");

        current_contact = contacts_json.filter(function(contact) {
            if (contact.id == id) return contact;
        });
        current_contact = current_contact[0];

        $contact_form.data('action', 'edit');
        $contact_form.data('id', id);

        $contact_form.find('#contact').val(current_contact.contact_number);
        $contact_form.find('#email').val(current_contact.email);
        $contact_form.find('#firstname').val(current_contact.firstname);
        $contact_form.find('#lastname').val(current_contact.lastname);

        $("#contact-modal").modal();

        $btn_add_save.text('Save');
    };

    var onDelete = function() {
        $current_tr = $(this).parent().parent();

        $("#delete-modal").modal();
    };

    $('#delete-modal .btn-yes').click(function() {
        $.get('<?= site_url('contact/delete/'); ?>' + $current_tr.data('id'))
            .done(function(data) {
                console.log(data);
                if (data.is_success) {
                    console.log('deleted');
                    location.reload();
                    $("#delete-modal").modal('hide');
                }
            });
    });

    $('.btn-edit').click(onEdit);
    $('.btn-delete').click(onDelete);

    $('.btn-add').click(function() {
        $contact_form.data('action', 'add');

        $btn_add_save.text('Add');

        $contact_form.find('input').val("");
    })

    $contact_form.validate({
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url: "<?= base_url('contact/check_email') ?>",
                    type: "post",
                    data: {
                        email: function() {
                            return encodeURI($contact_form.find('#email').val());
                        },
                        action: function() {
                            return $contact_form.data('action');
                        }
                    }
                }
            },
            contact: {
                required: true,
                remote: {
                    url: "<?= base_url('contact/check_contact') ?>",
                    type: "post",
                    data: {
                        contact: function() {
                            return $contact_form.find("#contact").val();
                        },
                        action: function() {
                            return $contact_form.data('action');
                        }
                    }
                }
            }
        },
        submitHandler: function(form) {
            $('.loading').show();

            if ($contact_form.data('action') == 'add') {
                $.post('<?= site_url('contact/create') ?>', $(form).serialize())
                    .done(function(data) {

                        if (data.is_success) {
                            var contact = data.result;
                            location.reload();
                            // $tr = $tr_template.clone();
                            // $tr.show();
                            // $tr.data('id', contact.id);

                            // $tr.find('.contact').text(contact.contact);
                            // $tr.find('.fullname').text(contact.firstname + " " + contact.lastname);
                            // $tr.find('.email').text(contact.email);
                            // $tr.find('.btn-edit').click(onEdit);
                            // $tr.find('.btn-delete').click(onDelete);

                            // $contact_table.find('tbody').append($tr);

                            $('#contact-modal').modal('hide');
                        }

                        $('.loading').hide();
                    });
            } else {
                $.post('<?= site_url('contact/update/') ?>' + current_contact.id, $(form).serialize())
                    .done(function(data) {
                        if (data.is_success) {
                            var contact = $contact_form.find('#contact').val();
                            var email = $contact_form.find('#email').val();
                            var firstname = $contact_form.find('#firstname').val();
                            var lastname = $contact_form.find('#lastname').val();

                            $current_tr.find('.contact').text(contact);
                            $current_tr.find('.email').text(email);
                            $current_tr.find('.firstname').text(firstname);
                            $current_tr.find('.lastname').text(lastname);

                            $('#contact-modal').modal('hide');
                        }

                        $('.loading').hide();
                    })
            }
        }
    });
</script>