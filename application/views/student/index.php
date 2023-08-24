<!-- Page header -->
<div class="page-header">
    <h3 class="page-title"> Students </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active " aria-current="page"><a href="#">Student</a></li>
        </ol>
    </nav>
</div>

<!-- Content -->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Students</h4>
                <p class="card-description">
                    <a href="<?= base_url('student/save') ?>" class="btn btn-xs btn-danger ">Create New</a>
                </p>
                <div class="table-responsive">
                    <table class="table table-dark  ">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Mobile </th>
                                <th> Email </th>
                                <th> Date Of Birth </th>
                                <th> Gender </th>
                                <th> Address </th>
                                <th class="text-center"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($students) :

                                foreach ($students as $k => $d) :
                            ?>
                                    <tr>
                                        <td><?= ++$k ?></td>
                                        <td><a href="<?= base_url("student/save/{$d->id}") ?>"><?= $d->name ?></a></td>
                                        <td><?= $d->mobile ?></td>
                                        <td><?= $d->email ?></td>
                                        <td><?= $d->dob ?></td>
                                        <td><?= $d->gender ?></td>
                                        <td><?= $d->address ?></td>
                                        <td><a href="<?= base_url("student/delete/{$d->id}") ?>" class="btn btn-xs btn-danger del-record">Delete</a> <a href="<?= base_url("student_payment/create/{$d->id}") ?>" class="btn btn-xs btn-primary">Pay</a> <a href="<?= base_url("student_payment/invoice/{$d->id}") ?>" class="btn btn-xs btn-primary">Invoice</a> </td>

                                    </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>