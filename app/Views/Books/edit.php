<?= $Header ?>
   
    <!-- <?php print_r($book) ?> for test inf data it is coming --> 

    <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit book data</h5>
                <p class="card-text">
                    <form method="post" action="<?= site_url('/update') ?>" enctype="multipart/form-data">
                        <input type="text" name="id" value="<?= $book['id']?>">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input id="name" class="form-control" type="text" name="name" value="<?= $book['name']?>">
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <br/>
                            <img class="img-thumbnail" src="<?=base_url()?>/uploads/<?= $book['image'];?>" width="180" alt="">
                            <input id="image" class="form-control-file" type="file" name="image">
                        </div>
                        <br/>
                        <button class="btn btn-success" type="submit">Edit</button>
                        <a href="<?= site_url('/getBooks') ?>" class="btn btn-info">Cancel</a>
                    </form>
                </p>
            </div>
    </div>
<?= $Footer ?>