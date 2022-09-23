<?php if ($_SESSION['yetki']==1){
function kullanicilar() { global $db; global $dil;
    breadcrumb('Kullanıcılar','Kullanıcı Listesi');
    $kullanicilar = $db->query("select * from kullanici order by id ASC")->fetchAll();

    print_r($_POST["ID"]);

    if(isset($_POST['sil'])){
        $id = $_POST["sil"];
        $kayitSil = $db->exec("delete from kullanici where ID='$id' limit 1");
        echo '<script> window.location.href = "kullanicilar"; </script>';
    }
    ?>

    <div class="container-xxl" id="kt_content_container">
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                              <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <input type="text" class="form-control form-control-solid w-250px ps-14" id="searchTags" placeholder="Arama">
                    </div>
                </div>
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <div class="w-100 mw-150px">
                    </div>
                    <a href="kullaniciEkle" class="btn btn-primary">Kullanıcı Ekle</a>
                </div>
            </div>
            <form class="silinecekSatirlar" method="POST">
                <div class="card-body pt-0">
                    <div id="kt_ecommerce_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_ecommerce_products_table">
                                <thead>
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2 sorting_disabled">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1">
                                        </div>
                                    </th>
                                    <th class="min-w-200px sorting">Ad Soyad</th>
                                    <th class="min-w-100px sorting">E-Posta</th>
                                    <th class="min-w-150px sorting">Telefon</th>
                                    <th class="min-w-100px sorting">Adres</th>
                                    <th class="min-w-100px sorting">Yetki</th>
                                    <th class="min-w-100px sorting">Durum</th>
                                    <th class="text-end min-w-100px sorting_disabled">İşlem</th>
                                </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600" id="menuFull">
                                <?php foreach($kullanicilar as $kullanici) { ?>
                                <tr class="even">
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void();" class="symbol symbol-50px">
                                                <span class="symbol-label" style="background-image:url(assets/upload//kullanici/<?=$kullanici['foto']?>);"></span>
                                            </a>
                                            <div class="ms-5">
                                                <a href="javascript:void();" class="text-gray-800 text-hover-primary fs-5 fw-bolder"><?=$kullanici['ad']." ".$kullanici['soyad']?></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pe-0">
                                        <span class="fw-bolder text-dark"><?=$kullanici['eposta']?></span>
                                    </td>
                                    <td class="pe-0" data-order="10">
                                        <span class="fw-bolder text-dark ms-3"><?=$kullanici['telefon']?></span>
                                    </td>
                                    <td class="pe-0">
                                        <span class="fw-bolder text-dark"><?=$kullanici['adres']?></span>
                                    </td>
                                    <?php if ($kullanici['yetki']==1) { ?>
                                        <td class="pe-0" data-order="Inactive">
                                            <div class="badge badge-light-primary min-w-70px">Yönetici</div>
                                        </td>
                                    <?php } else { ?>
                                        <td class="pe-0" data-order="Inactive">
                                            <div class="badge badge-light-warning min-w-70px">Üye</div>
                                        </td>
                                    <?php } ?>
                                    <?php if ($kullanici['durum']==1) { ?>
                                        <td class="pe-0" data-order="Inactive">
                                            <div class="badge badge-light-success min-w-70px">Aktif</div>
                                        </td>
                                    <?php } else { ?>
                                        <td class="pe-0" data-order="Inactive">
                                            <div class="badge badge-light-danger min-w-70px">Pasif</div>
                                        </td>
                                    <?php } ?>
                                    <td class="text-end">
                                        <a href="kullaniciDuzenle/<?=$kullanici['ID']?>" class="btn btn-icon btn-light-primary btn-sm">
                                            <i class="far fa-edit fs-7"></i>
                                        </a>
                                        <button type="submit" name="sil" value="<?=$kullanici['ID']?>" class="btn btn-icon btn-light-danger btn-sm">
                                            <i class="fas fa-trash-alt fs-7"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                <div class="dataTables_length" id="kt_ecommerce_products_table_length">
                                    <label>
                                        <select disabled name="kt_ecommerce_products_table_length" aria-controls="kt_ecommerce_products_table" class="form-select form-select-sm form-select-solid">
                                            <option value="10">100</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                <div class="dataTables_paginate paging_simple_numbers" id="kt_ecommerce_products_table_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous" id="kt_ecommerce_products_table_previous">
                                            <a href="#" aria-controls="kt_ecommerce_products_table" data-dt-idx="0" tabindex="0" class="page-link">
                                                <i class="previous"></i>
                                            </a>
                                        </li>
                                        <li class="paginate_button page-item active">
                                            <a href="#" aria-controls="kt_ecommerce_products_table" data-dt-idx="5" tabindex="0" class="page-link">1</a>
                                        </li>
                                        <li class="paginate_button page-item next disabled" id="kt_ecommerce_products_table_next">
                                            <a href="#" aria-controls="kt_ecommerce_products_table" data-dt-idx="6" tabindex="0" class="page-link">
                                                <i class="next"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

 <?php } } ?>