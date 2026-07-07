<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Data Notifikasi</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive m-t-20">
                    <table id="myTable" class="table table-bordered table-striped " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>



    </div>
</main>
<script>
    $(document).on("click", ".click", function () {
        var myBookId = $('#btn').data('id');
	$.get("notifikasi/set_session/" + myBookId, function (result) {								        
							})
	})
</script>
<!-- END Main Container -->