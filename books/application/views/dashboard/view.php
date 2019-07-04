 <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detil Buku</h1>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Cover Buku</th>
              <th>Judul Buku</th>
              <th>Pengarang</th>
              <th>Penerbit</th>
              <th>Tahun Terbit</th>
              <th>Sinopsis</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td><img src="<?php echo "http://localhost/books/assets/images/" .$books['imgfile']?>"></td>
              <td><?php echo $books['judul']?></td>
              <td><?php echo $books['pengarang']?></td>
              <td><?php echo $books['penerbit']?></td>
              <td><?php echo $books['thnterbit']?></td>
              <td><?php echo $books['sinopsis']?></td>
            </tr>
            
          </tbody>
        </table>
      </div>
    </main>