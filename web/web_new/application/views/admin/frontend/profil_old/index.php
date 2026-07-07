<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style>
<!-- Main Container -->
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Data Profil</h3>
                <button type="button" class="btn btn-secondary" id="tambah_data" 
                style="margin-bottom:10px;" data-toggle="modal" data-target="#formModalTambah">
                <i class="fa fa-plus"></i> Tambah Profil</button>  
            </div>

            <div class="block-content">
                    <table id="myTable" class="table table-bordered table-striped table-vcenter">
                    <thead>
            			<tr>
            				<th>No</th>
            				<th>Judul</th> 
            				<th style="text-align: center;">Thumbnail</th> 
            				<th style="text-align: center;">Action</th>
            			</tr>
            		</thead> 
                        
                    </table>
                </div>

        </div>

    </div>
</main>
<!-- END Main Container -->