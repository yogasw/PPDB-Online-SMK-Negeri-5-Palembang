<script src="http://arioki.web/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>

<script language="javascript">

       multiList= [
//1-5
        {
            ques: "Hasil dari (- 12) : 3 + 8 x (- 5) adalah ...",
            ans: "- 44",
            ansSel: ["- 36 ", "28","48"]
        },
        {
            ques: "Beni menjumlahkan nomor-nomor halaman buku yang terdiri dari 96 halaman adalah 4.672. Ternyata terjadi kekeliruan, ada 1 halaman yang dihitung 2 kali. Halaman berapakah itu ?",
            ans: "18",
            ansSel: ["24", "36","16"]
        },
        {
            ques: "Suatu pekerjaan dapat diselesaikan oleh 15 pekerja dalam waktu 12 minggu. Jika pekerjaan itu harus selesai dalam 9 minggu, banyak pekerja yang harus ditambah adalah ...",
            ans: "5 orang",
            ansSel: ["4 orang", "3 orang","20 orang"]
        },
        {
            ques: "Hasil dari 2<sup>-3</sup> x 2<sup>2</sup> = ...",
            ans: "<sup>1</sup>/<sub>32</sub>",
            ansSel: ["<sup>1</sup>/<sub>64</sub>", "- 2","- 32"]
        },
        {
            ques: "Hasil dari √32 - √2 + √128 adalah ...",
            ans: "11 √2",
            ansSel: ["13 √2", "9√2","6√2"]
        },
//6-10
        {
            ques: "Rudi menabung pada sebuah bank sebesar Rp. 800.000,00 dengan bunga 25% setahun. Jika tabungannya sekarang Rp. 950.000,00. Maka lama ia menabung adalah ...",
            ans: "9 bulan",
            ansSel: ["6 bulan", "8 bulan","4 bulan"]
        },
        {
            ques: "Ali menjual sepeda seharga Rp. 500.000,00 dan ia mendapat untung 25% dari harga pembeliannya. Berapakah harga pembelian sepeda tersebut ?",
            ans: "Rp. 400.000,00",
            ansSel: ["Rp. 375.000,00", "Rp. 475.000,00","Rp. 625.000,00"]
        },
        {
            ques: "Dua suku berikutnya dari barisan bilangan 20,17,13,8,... adalah ...",
            ans: "2, -5",
            ansSel: ["1, -8", "5, 0","5, 2"]
        },
        {
            ques: "Bentuk sederhana dari 2x<sup>2</sup> - x - 6 + 5x<sup>2</sup> - 5x + 10 adalah ...",
            ans: "7x<sup>2</sup> - 6x + 4",
            ansSel: ["7x<sup>2</sup> - 6x - 4", "7x<sup>2</sup> + 6x + 4","7x<sup>2</sup> - 5x - 13"]
        },
        {
            ques: "Diketahui 5(x+3) - 25 = 3(4x-1). Nilai dari x-1 adalah ...",
            ans: "-2",
            ansSel: ["2", "-1","1"]
        },
//11-15
        {
            ques: "Himpunan penyelesaian dari 5x - 20 ≤ 40 + 8x, untuk x anggota bilangan bulat adalah ...",
            ans: "{-20,-19,-18,...}",
            ansSel: ["{...,-22,-21,-20}", "{...,-23,-22,-21}","{-19,-18,-17,...}"]
        },
        {
            ques: "Banyak himpunan bagian dari A = {x|x < 11, x bilangan ganjil} adalah ...",
            ans: "32",
            ansSel: ["5", "6","64"]
        },
        {
            ques: "Dari 143 siswa, 95 siswa senang matematika, 87 siswa senang fisika, dan 60 siswa senang keduanya. Banyak siswa yang tidak senang matematika maupun fisika adalah ...",
            ans: "21 orang",
            ansSel: ["27 orang", "35 orang","122 orang"]
        },
        {
            ques: "Diketahui rumus fungsi f(x)= 5x - 3. Hasil dari f (3x+2) adalah ...",
            ans: "15x + 7",
            ansSel: ["15x - 6", "15 - 1","8x - 1"]
        },
        {
            ques: "Persamaan garis yang melalui titik (-3,6) dan (1,4) adalah ...",
            ans: "x + 2y = 9",
            ansSel: ["2x + y = 15", "x - 2y = 15","2x - y = 9"]
        },
//16-20
        {
            ques: "Penyelesaian dari sistem persamaan x - 3y = 1 dan x - 2y = 2 adalah x dan y. Nilai 2x - 5y adalah ...",
            ans: "3",
            ansSel: ["-3", "7","-7"]
        },
        {
            ques: "Perhatikan kelompok panjang sisi-sisi suatu segitiga berikut : <br>(i) 3 cm, 5 cm, 7 cm<br>(ii)7 cm, 24 cm, 26 cm<br>(iii)16 cm, 30 cm, 34 cm<br>(iv)10 cm, 24 cm, 25 cm<br><br>yang merupakan panjang sisi segitiga siku-siku adalah ...",
            ans: "(iii)",
            ansSel: ["(i)", "(ii)","(iv)"]
        },
        {
            ques: "Sebuah taman berbentuk persegi panjang berukuran (30 m x 18 m). Di sekeliling taman dipasang tiang lampu dengan jarak antar lampu 6 m. Jika harga tiap tiang lampu Rp. 200.000 per tiang, maka biaya yang diperlukan seluruhnya adalah ...",
            ans: "Rp. 3.200.000,00",
            ansSel: ["Rp. 2.400.000,00", "Rp. 4.800.000,00","Rp. 4.000.000,00"]
        },
        {
            ques: "Banyak bidang diagonal pada kubus adalah ...",
            ans: "6 dan 4",
            ansSel: ["4 dan 6", "8 dan 6","6 dan 8"]
        },
        {
            ques: "Dari rangkaian persegi berikut : <br> <img src=https://2.bp.blogspot.com/-qd6Ntj9PvGM/V-u3_NCSCdI/AAAAAAAAAvY/mmmzTPw00L8OyjbucmT9H80zuk1LyoolgCLcB/s1600/saf.PNG> <br> yang merupakan jaring-jaring kubus adalah ...",
            ans: "1 dan 4",
            ansSel: ["1 dan 3", "2 dan 3","2 dan 4"]
        },
    ];

    for (var i = 0, l = multiList.length; i < l; i++) {
        var soal = multiList[i]['ques'];
        var jawaban = multiList[i]['ans'];
        var a = multiList[i]['ansSel'][0];
        var b = multiList[i]['ansSel'][1];
        var c = multiList[i]['ansSel'][2];
        $.ajax({
            url: "http://arioki.web/ajax/kirim_soal",
            method: "POST",
            data: {
                soal: soal,
                id_mapel: 5,
                jawaban: jawaban,
                a: a,
                b: b,
                c: c
            },
        }).done(function (response) {

        }).fail(function (jqXHR, textStatus) {

        });
    }


</script>

