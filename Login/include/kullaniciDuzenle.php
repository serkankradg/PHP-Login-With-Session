<?php if ($_SESSION['yetki']==1){
function kullaniciDuzenle() { global $db; global $menu;
    breadcrumb('Kullanıcılar','Kullanıcı Düzenleme');

    if (isset($_POST['guncelle'])) {

        $klasor = 'assets/upload/kullanici';
        $dosya = $_FILES['file'];
        $gelenformat = $dosya['type'];
        $dosya_tmp = $dosya['tmp_name'];
        $uzanti	= explode("/",$gelenformat);
        $dosyaformati = array("image/jpeg", "image/gif", "image/jpg", "image/png");
        $zaman = time();
        if (in_array($gelenformat,$dosyaformati)) {
            $yuklenendosya=$klasor.'/'.$zaman.dosyaadi($dosya[count($dosya)-1].'.'.$uzanti[1]);
            move_uploaded_file($dosya_tmp,$yuklenendosya);
            $yuklenendosyaadi=$zaman.dosyaadi($dosya[count($dosya)-1].'.'.$uzanti[1]);
            $fotoekle="foto = '$yuklenendosyaadi',";
        }

        $durum = (isset($_POST["durum"])) ? '1' : '0';
        $yetki=$_POST["yetki"];
        $ad=$_POST["ad"];
        $soyad=$_POST["soyad"];
        $eposta=$_POST["eposta"];
        $telefon=$_POST["telefon"];
        $adres=$_POST["adres"];
        $tc=$_POST["tc"];
        $kullaniciAdi=$_POST["kullaniciAdi"];
        $sifre=$_POST["sifre"];

        $ekle = $db->exec("
        update kullanici set 
        durum = '$durum',
        yetki = '$yetki',
        ad = '$ad',
        soyad = '$soyad',
        eposta = '$eposta',
        telefon = '$telefon',
        adres = '$adres',
        tc = '$tc',
        kullaniciAdi = '$kullaniciAdi',
        sifre = '$sifre',
        $fotoekle
        dil = '1'
        where id='$menu[2]'
    ");
    }

    $kullanici = $db->query("select * from kullanici where ID=$menu[2]")->fetch();
    ?>

    <div id="kt_content_container" class="container-xxl">
        <form name="sayfa_ekle" method="post" enctype="multipart/form-data">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h3 class="card-title">Kullanıcı Düzenleme</h3>
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="kullanicilar">Kullanıcılar</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="form_tab_1" role="tabpanel">
                            <div class="row mb-6">
                                <?php $checked = ($kullanici['durum'] == 1) ? 'checked="checked"' : ''; ?>
                                <label class="col-lg-3 col-form-label fw-bold fs-6">Durum</label>
                                <div class="col-lg-8 d-flex align-items-center">
                                    <div class="form-check form-check-solid form-switch fv-row">
                                        <input class="form-check-input w-45px h-30px" type="checkbox" name="durum" id="durum" <?=$checked?>>
                                        <label class="form-check-label" for="durum"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">Ad</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="ad" class="form-control form-control-lg form-control-solid" placeholder="Kullanıcı adı" value="<?=$kullanici['ad']?>">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">Soyad</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="soyad" class="form-control form-control-lg form-control-solid" placeholder="Kullanıcı soyadı" value="<?=$kullanici['soyad']?>">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">E-Posta</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="eposta" class="form-control form-control-lg form-control-solid" placeholder="Kullanıcı E-posta adresi" value="<?=$kullanici['eposta']?>">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">Telefon</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="telefon" class="form-control form-control-lg form-control-solid" placeholder="Kullanıcı telefon numarası" value="<?=$kullanici['telefon']?>">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">Yetki</label>
                                <div class="col-lg-9 fv-row">
                                    <?php $yonetici = ($kullanici['yetki']==1) ? 'selected' : '';
                                          $uye = ($kullanici['yetki']==2) ? 'selected' : ''; ?>
                                    <select name="yetki" aria-label="Yetki" data-control="select2" data-placeholder="Seçim yapılmadı" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-5-b8z8" tabindex="-1" aria-hidden="true">
                                        <option value="">Seçim yapılmadı</option>
                                        <option value="1" <?=$yonetici?>>Yönetici</option>
                                        <option value="2" <?=$uye?>>Üye</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">Kullanıcı Adı</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="kullaniciAdi" class="form-control form-control-lg form-control-solid" placeholder="Kullanıcı giriş adı" value="<?=$kullanici['kullaniciAdi']?>">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">Şifre</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="sifre" class="form-control form-control-lg form-control-solid" placeholder="Kullanıcı giriş şifresi" value="<?=$kullanici['sifre']?>">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">TC Kimlik</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="tc" class="form-control form-control-lg form-control-solid" placeholder="Kullanıcı tc numarası" value="<?=$kullanici['tc']?>">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">Adres</label>
                                <div class="col-lg-9 fv-row">
                                    <textarea name="adres" class="form-control form-control-lg form-control-solid" rows="5"><?=$kullanici['adres']?></textarea>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label fw-bold fs-6">Profil Resmi</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="file" name="file" class="form-control form-control-lg form-control-solid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5 mt-3 mb-xl-10">
                <div id="kt_account_profile_details" class="collapse show">
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" name="guncelle" class="btn btn-primary mx-3" id="kt_account_profile_details_submit">Güncelle</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?php } } ?>