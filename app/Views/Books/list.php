<?= $Header ?>

    <div class="container">

        <a href="<?= base_url('create') ?>" class="btn btn-success">Create Book</a>
        <br/>
        <br/>

        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Books as $book): ?>
                    <tr>
                        <td><?= $book['id'];?></td>
                        <td><?= $book['name']; ?></td>
                        <td>
                            <img class="img-thumbnail" src="<?=base_url()?>/uploads/<?= $book['image'];?>" width="180" alt="">
                        </td>
                        <td>
                            <a href="<?= base_url('edit/'.$book['id']); ?>" class="btn btn-info" type="button">Edit</a>
                            <a href="<?= base_url('delete/'.$book['id']); ?>" class="btn btn-danger" type="button">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </div>
    
<?= $Footer ?>