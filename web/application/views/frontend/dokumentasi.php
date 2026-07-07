<!doctype html>
<html lang="id"> 
<head>
	<title> Dokumentasi API </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<style type="text/css">
	.bg_tr{
		background: rgba(155,155,155,0.1);
		text-align: center;
	}
	.table tbody tr td{  
         padding: 5px 7.5px 5px 7.5px;
    }
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<h2 style="margin: 20px;"><span class="bd-content-title"> Dokumentasi API BPBD </span></h2>
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Halaman</th>
		      <th scope="col">Keterangan</th>
		      <th scope="col">Method</th>
		      <th scope="col">Header</th>
		      <th scope="col">Body</th>
		      <th scope="col">Link</th>
		    </tr>
		  </thead>
		  <tbody>
		  <tr>
		      <td colspan="7" class="bg_tr">  Setting </td> 
		    </tr> 
		    <tr>
		      <td>1</td>
		      <td>Layout</td>
		      <td>(Header/footer)</td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/setting</td>
		    </tr>  
		  	<tr>
		      <td colspan="7" class="bg_tr">  Halaman Home </td> 
		    </tr> 
		    <tr>
		      <td>1</td>
		      <td>Home</td>
		      <td>Slider</td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/home/slider</td>
		    </tr>  
		    <tr>
		      <td>2</td>
		      <td>Home</td>
		      <td>Pesan Singkat</td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/home/pesan_singkat</td>
		    </tr>  
		    <tr>
		      <td>3</td>
		      <td>Home</td>
		      <td>Detail Pesan Singkat</td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/home/detail_pesan_singkat/1</td>
		    </tr>   
		    <tr>
		      <td>4</td>
		      <td>Home</td>
		      <td>Berita Terbaru</td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/home/berita_terbaru</td>
		    </tr>
		    <tr>
		      <td>5</td>
		      <td>Home</td>
		      <td>Detail Berita</td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/berita/detail/5</td>
		    </tr>    
		    <tr>
		      <td colspan="7" >  &nbsp; </td> 
		    </tr>  
		    <tr>
		      <td colspan="7" class="bg_tr">  Halaman Berita </td> 
		    </tr> 
		    <tr>
		      <td>1</td>
		      <td>Berita</td>
		      <td>Kategori Berita </td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/berita/kategori</td>
		    </tr>  
		    <tr>
		      <td>2</td>
		      <td>Berita</td>
		      <td>All Berita </td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/berita</td>
		    </tr>  
		    <tr>
		      <td>3</td>
		      <td>Berita</td>
		      <td> 
		      	<div> ID Kategori : </div>
		      	<div>
		      		<ul> 
		      			<li> id = 1->Longsor </li>
		      			<li> id = 2->Banjir </li> 
		      		</ul>
		      	</div>
		      </td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td> 
		      	<div> Link : </div>
		      	<div>
		      		<ul> 
		      			<li> https://appl.demoo.id/sukoharjo/bpbd/Front/api/berita/berita_kategori/1</li> 
		      			<li> https://appl.demoo.id/sukoharjo/bpbd/Front/api/berita/berita_kategori/2</li>  
		      	</div>
		      </td>
		    </tr>  
		    <tr>
		      <td>4</td>
		      <td>Berita</td>
		      <td>Detail Berita</td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/berita/detail/5</td>
		    </tr>  

		    <tr>
		      <td colspan="7" >  &nbsp; </td> 
		    </tr>  
		    <tr>
		      <td colspan="7" class="bg_tr">  Halaman Agenda Kegiatan </td> 
		    </tr>  
		    <tr>
		      <td>1</td>
		      <td>Agenda Kegiatan</td>
		      <td>All Agenda Kegiatan </td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/agenda_kegiatan</td>
		    </tr>  
		     
		    <tr>
		      <td>2</td>
		      <td>Agenda Kegiatan</td>
		      <td>Detail Agenda Kegiatan</td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/agenda_kegiatan/detail/6</td>
		    </tr>  


		    <tr>
		      <td colspan="7" >  &nbsp; </td> 
		    </tr>  
		    <tr>
		      <td colspan="7" class="bg_tr">  Halaman Informasi Kebencanaan </td> 
		    </tr>  
		    <tr>
		      <td>1</td>
		      <td>Informasi Kebencanaan</td>
		      <td>All Informasi Kebencanaan </td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/informasi_kebencanaan</td>
		    </tr>  
		     
		    <tr>
		      <td>2</td>
		      <td>Informasi Kebencanaan</td>
		      <td>Detail Informasi Kebencanaan</td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/informasi_kebencanaan/detail/22</td>
		    </tr>  

		    <tr>
		      <td colspan="7" >  &nbsp; </td> 
		    </tr>  
		    <tr>
		      <td colspan="7" class="bg_tr">  Halaman Unduhan </td> 
		    </tr> 
 
		    <tr>
		      <td>1</td>
		      <td>Unduhan</td>
		      <td>All Unduhan </td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/unduhan</td>
		    </tr>  

		    <tr>
		      <td colspan="7" >  &nbsp; </td> 
		    </tr>  
		    <tr>
		      <td colspan="7" class="bg_tr">  Halaman Galeri </td> 
		    </tr> 
		    <tr>
		      <td>1</td>
		      <td>Galeri</td>
		      <td>Album </td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/Front/api/galeri</td>
		    </tr>  
		    
		    <tr>
		      <td>3</td>
		      <td>Galeri</td>
		      <td> 
		      	<div> Detail Album : </div>
		      	<div>
		      		<ul> 
		      			<li> id = 12->Album 1 </li>
		      			<li> id = 14->Album 2 </li> 
		      		</ul>
		      	</div> 
		      	<div> Jenis Galeri : </div>
		      	<div>
		      		<ul> 
		      			<li> jenis = 0->Foto</li>
		      			<li> jenis = 1->Video</li> 
		      		</ul>
		      	</div>
		      </td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td> 
		      	<div> Link : </div>
		      	<div>
		      		<ul> 
		      			<li> https://appl.demoo.id/sukoharjo/bpbd/Front/api/galeri/detail/12</li> 
		      			<li> https://appl.demoo.id/sukoharjo/bpbd/Front/api/galeri/detail/14</li>  
		      	</div>
		      </td>
		    </tr>  

		    <tr>
		      <td colspan="7" >  &nbsp; </td> 
		    </tr>  
		    <tr>
		      <td colspan="7" class="bg_tr">  Api Info Gempa </td> 
		    </tr> 
 
		    <tr>
		      <td>1</td>
		      <td>Info Gempa</td>
		      <td>Informasi Gempa Bumi Dirasakan</td>
		      <td>GET</td>
		      <td>None</td>
		      <td>None</td>
		      <td>https://appl.demoo.id/sukoharjo/bpbd/datatables/api_gempa</td>
		    </tr>  
		    <tr>
		      <td colspan="7" >  &nbsp; </td> 
		    </tr>  

		  </tbody>
		</table>
			

		</div>
	</div>
</div>


</body>
</html>