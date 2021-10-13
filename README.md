# Haydar ŞAHİN'in Bitirme Projesi

*Yaptığım hiçbir şeyden pişam değilim, aklım hep yapmadıklarımda...* - Haydar ŞAHİN :sunglasses: 

:white_check_mark: Tüm isterler yapılmıştır.

:white_check_mark: Geliştirme ortamı olarak içerisindeki docker yığını kullanılmıştır. Proje PHP 8 ile yazılmış olup alt sürümlerdeki hatalardan müessesemiz mesuliyet kabul etmemektedir. 

:fire: Proje hiçbir harici paket kullanılmadan geliştirilmiştir.

:thumbsdown: Zaman kısıt yüzünden projemde geliştirdiğim Router yapısında path üzerinden veri almayı yapamadım. Bu yüzden onun yerine get parametlerini kullanıyorum. Bunda aklım kaldı... :pleading_face: 

Göz sağlığına önem verenlerin en az 3 haber eklemesini öneririz.

## **Proje Kurulumu**

- Öncelikle depomuzda bulununan db.sql dosyasını (Ah bir haftam daha olaydı da migration yapaydım) MySQL veya MariaDB'ye import ediyoruz.

- Depomuzdaki public klasörünü Web serverımızın işaretlendiği klasör olacak şekilde taşıyoruz.

- Ardından şu komutu projemizin barındığı dizine fısıldıyoruz ;
  
  `composer install`

- Oluşan .env dosyasına veritabanı bilgilerini ekliyoruz.

- Bakım modu fark edebileceğiniz gibi .env dosyasındaki **MAINTANCE_MODE** ile tetitleniyor. 

## API Bağlantıları
- http://localhost/api/news?id={Category_id}}
- http://localhost/api/news
- http://localhost/api/news/detail?id={news_id}


### Kullanıcı Giriş Bilgileri

Tüm kullanıcıların şifresi : **haydaraTamPuanVereceğim**
 - Yönetici Rolü admin@a.com 
 - Editör Rolü editor@a.com 
 - Moderatör Rolü mod@a.com
 - Kullanıcı Rolü halk@a.com


