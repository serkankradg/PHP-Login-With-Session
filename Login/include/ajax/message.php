<?php include '../../connection/connect.php';

$id = $_POST['id'];
$mesaj = $_POST['mesaj'];

$ekle = $db->exec("
        insert into mesaj set 
        kullanici = '$id',
        mesaj = '$mesaj'
    ");


$mesajlar = $db->query("select * from mesaj order by ID asc ")->fetchAll();
foreach ($mesajlar as $mesaj) {
    $id = $mesaj['kullanici'];
    $gonderen = $db->query("select * from kullanici where ID='$id'")->fetch();
    if ($_SESSION['ID'] == $mesaj['kullanici']) {
        echo '
        <div class="d-flex justify-content-end mb-10">
            <div class="d-flex flex-column align-items-end">
                <div class="d-flex align-items-center mb-2">
                    <div class="me-3">
                        <a href="javascript:void(0);" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">' . $gonderen["ad"] . " " . $gonderen["soyad"] . '</a>
                    </div>
                    <div class="symbol symbol-35px symbol-circle">
                        <img alt="Pic" src="assets/media/avatars/150-10.jpg">
                    </div>
                </div>
                <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">' . $mesaj["mesaj"] . '</div>
            </div>
        </div>
        ';
    } else {
        echo '
        <div class="d-flex justify-content-start mb-10">
            <div class="d-flex flex-column align-items-start">
                <div class="d-flex align-items-center mb-2">
                    <div class="symbol symbol-35px symbol-circle">
                        <img alt="Pic" src="assets/media/avatars/150-1.jpg">
                    </div>
                    <div class="ms-3">
                        <a href="javascript:void(0);" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">' . $gonderen["ad"] . " " . $gonderen["soyad"] . '</a>
                    </div>
                </div>
                <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">' . $mesaj["mesaj"] . '</div>
            </div>
        </div>
        ';
    }
}