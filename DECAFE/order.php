<?php
include "proses/connect.php";
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT tb_order.*,nama, SUM(harga*jumlah) AS harganya FROM tb_order
LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
GROUP BY id_order
");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

// $select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu,kategori_menu  FROM tb_kategori_menu");

?>
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Order
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"> tambah
                        Order</button>
                </div>
            </div>

            <!-- Modal tambah Order baru-->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order Makanan Dan Minuman</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_order.php"
                                method="POST">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="uploudFoto" name="kode_order"
                                                value="<?php echo date('ymdHi') . rand(100, 999) ?>" readonly>
                                            <label for="uploudFoto">Kode Order</label>
                                            <div class="invalid-feedback">
                                                Masukkan Kode Order
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="meja" placeholder="Nomor Meja"
                                                name="meja" required>
                                            <label for="meja">Meja</label>
                                            <div class="invalid-feedback">
                                                Masukkan Meja
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="pelanggan"
                                                placeholder="Nama Pelanggan" name="pelanggan" required>
                                            <label for="pelanggan">Nama Pelanggan</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Pelanggan
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_order_validate"
                                        value="12345">Buat Order </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!--  Akhir Modal tambah Order baru-->
            <?php
            if (empty($result)) {
                echo "Data Menu Makanan Atau Minuman tidak ada";
            } else {
                foreach ($result as $row) {
                    ?>


                    <!-- Modal edit-->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_order'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan Dan Minuman</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_order.php"
                                        method="POST">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-floating mb-3">
                                                    <input readonly="" type="text" class="form-control" id="uploudFoto"
                                                        name="kode_order" value="<?php echo $row['id_order'] ?>" readonly>
                                                    <label for="uploudFoto">Kode Order</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Kode Order
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="meja" placeholder="Nomor Meja"
                                                        name="meja" required value="<?php echo $row['meja'] ?>">
                                                    <label for="meja">Meja</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Meja
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="pelanggan"
                                                        placeholder="Nama Pelanggan" name="pelanggan" required
                                                        value="<?php echo $row['pelanggan'] ?>">
                                                    <label for="pelanggan">Nama Pelanggan</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Nama Pelanggan
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="edit_order_validate"
                                                value="12345">SIMPAN </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal edit-->

                    <!-- Modal DELETE-->
                    <div class="modal fade" id="ModalDelete<?php echo $row['id_order'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">DELETE DATA USER</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_delete_order.php"
                                        method="POST">
                                        <input type="hidden" value="<?php echo $row['id_order'] ?>" name="kode_order">

                                        <div class="col-lg-12">
                                            Apakah Anda Yakin Ingin Menghapus Order atasnama
                                            <b><?php echo $row['pelanggan'] ?></b>dengan kode order
                                            <b><?php echo $row['id_order'] ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete_order_validate"
                                                value="12345">Hapus</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal DELETE-->
                    <?php
                }
                ?>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">NO</th>
                                <th scope="col">KODE ORDER</th>
                                <th scope="col">PELANGGAN</th>
                                <th scope="col">MEJA</th>
                                <th scope="col">TOTAL HARGA</th>
                                <th scope="col">PELAYAN</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">WAKTU ORDER</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>

                                    <td><?php echo $row['id_order'] ?></td>
                                    <td><?php echo $row['pelanggan'] ?></td>
                                    <td><?php echo $row['meja'] ?></td>
                                    <td><?php echo number_format((int) $row['harganya'], 0, ',', '.') ?></td>

                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td><?php echo $row['waktu_order'] ?></td>

                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-info btn-sm me-1" href="./?x=orderitem&order=<?php echo $row['id_order'] . "&meja=" .
                                                $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>"><i
                                                    class="bi bi-eye"></i></a>
                                            <button
                                                class=" <?php echo (!empty($row['id_bayar'])) ? " btn btn-secondary disabled" : "btn btn-success"; ?>"
                                                data-bs-toggle="modal" data-bs-target="#tambahitem">
                                                <i class="bi bi-plus-circle-fill"></i> Item</button>
                                            <button
                                                class="<?php echo (!empty($row['id_bayar'])) ? " btn btn-secondary disabled" : "btn btn-primary"; ?>"
                                                data-bs-toggle="modal" data-bs-target="#tambahitem" data-bs-toggle="modal"
                                                data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>

                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }
            ?>
        </div>

    </div>
</div>