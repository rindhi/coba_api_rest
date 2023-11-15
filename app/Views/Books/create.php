<?= $Header ?>
    create formulario...


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Enter book data</h5>
            <p class="card-text">
                <form method="post" action="<?= site_url('/save') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input id="name" value="<?= old('name') ?>" class="form-control" type="text" name="name">
                    </div>
                    <br/>
                    <br/>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input id="image" class="form-control-file" type="file" name="image">
                    </div>
                    <button class="btn btn-success" type="submit">Save</button>
                    <a href="<?= site_url('/getBooks') ?>" class="btn btn-info">Cancel</a>
                </form>
            </p>
        </div>
    </div>
    
<?= $Footer ?>
