<?php
class About {
    public function index ($nama = 'Azikra', $pekerjaan = 'Mahasiswa')
    {
        echo "Hai, nama saya $nama, saya adalah seorang $pekerjaan";
    }


    public function page ()
    {
        echo 'About/page';
    }
}