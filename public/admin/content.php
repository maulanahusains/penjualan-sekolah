<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Hoverable Table <a href="" class="btn btn-info float-right">Tambah</a></h4>
                    <p class="card-description"> Add class <code>.table-hover</code>
                    </p>
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Sale</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>Photoshop</td>
                                <td>28.76%</td>
                                <td>Pending</td>
                                <td>
                                    <a href="" class="btn btn-warning">Edit</a>
                                    <!-- onclick="Delete(url) untuk url disesuaikan contoh '/user/delete/{{$row->id}}'" -->
                                    <button class="btn btn-danger" onclick="Delete('/url_delete')">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>