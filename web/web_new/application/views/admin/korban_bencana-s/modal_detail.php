<style type="text/css">
    #detail_pemilik_umkm tr td {
        padding: 3px 2px 3px 2px;
    }
    #detail_pemilik_umkm tbody tr td.col_1{
        width       : 140px;  
        color       : #444;
    }
    #detail_pemilik_umkm tbody tr td.col_2{
        width       : 12px;  
    }
    #detail_pemilik_umkm tr tbody td.col_3{
        width       : auto;  
    }
</style>
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin" role="document"> 
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title model_title">Detail Korban Bencana</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i> 
                        </button>
                    </div>
                </div>
				<div class="block-content">
					<table class="table" id="detail_pemilik_umkm" style="width: 100%; padding: 0px;">
                        <tr>
                            <td class="col_1"> NIK </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><b id="detail_nik" style="color: #e87a37;"></b></td>
                        </tr> 
						<tr>
                            <td class="col_1"> NOMOR KK </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><span id="detail_nomor_kk"></span></td>
                        </tr> 
                        <tr>
                            <td class="col_1"> Nama </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><span id="detail_nama_lengkap"></span></td>
                        </tr>
                        <tr>
                            <td class="col_1"> Jenis Kelamin </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><span id="detail_jenis_kelamin"></span></td> 
                        </tr>
                        
                        <tr>
                            <td class="col_1"> Alamat Lengkap </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><span id="detail_alamat_lengkap"></span></td>
                        </tr>
                        <tr>
                            <td class="col_1"> RT/RW </td>
                            <td class="col_2"> : </td>
                            <td class="col_3">
                            <span id="detail_rt"></span> / <span id="detail_rw"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="col_1"> Kelurahan </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><span id="detail_kelurahan"></span></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #DFE3E7">
                            <td class="col_1"> Kecamatan </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><span id="detail_kecamatan"></span></td>
                        </tr> 
						<tr>
                            <td class="col_1"> Kabupaten </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><span id="detail_kabupaten"></span></td>
                        </tr>
						<tr>
                            <td class="col_1" colspan="3" style="height: 10px;">  </td> 
                        </tr>
						<tr>
                            <td class="col_1"> Kategori Bencana </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><span id="detail_kategori_bencana"></span></td>
                        </tr>
						<tr>
                            <td class="col_1"> Keterangan </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><span id="detail_keterangan"></span></td>
                        </tr>
						<tr>
                            <td class="col_1"> Foto </td>
                            <td class="col_2"> : </td>
                            <td class="col_3"><span id="detail_foto"></span></td>
                        </tr>
                    </table> 
				</div>  
				<div class="modal-footer">   
					<button type="button" class="btn btn-alt-secondary" data-dismiss="modal"> Tutup </button> 
				</div> 
			</div>
		</div> 
	</div>
</div> 