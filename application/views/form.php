<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin-top: 100px;">
            <h1 class="text-center">Upload data</h1>
            <form method="post" action="<?= site_url('App/save') ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Category name</label>
                    <input class="form-control" type="file" name="xlsx" />
                </div>
                <div class="form-group">
                    <a href="<?= site_url('App/download') ?>">Download demo file</a>
                </div>
                <div class="form-group">
                    <input type="submit" value="Save" class="btn btn-primary" />
                </div>
            </form>
        </div>
        <div class="col-md-6" style="margin-top: 100px; padding:15px">
            <?php if (!empty($users)) { ?>
                <div class="responsive">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>State</th>
                            <th>City</th>
                        </tr>
                        <?php foreach ($users as $usr) { ?>
                            <tr>
                                <td><?= $usr->name ?></td>
                                <td><?= $usr->email ?></td>
                                <td><?= $usr->phone ?></td>
                                <td>
                                    <select>
                                        <?php foreach ($state as $s) { ?>
                                            <option value="<?= $s->id ?>" <?= ($s->id == $usr->state_id ? 'selected' : '') ?>><?= $s->state_name ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <select>
                                        <?php foreach ($city as $s) { ?>
                                            <option value="<?= $s->id ?>" <?= ($s->id == $usr->city_id ? 'selected' : '') ?>><?= $s->city_name ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>