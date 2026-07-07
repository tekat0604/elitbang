<div class="marq-ini bg-gradient-magenta-orange-2">
        <div class="container">
            <div class="row text-white align-items-center py-md-0 py-3">
                <div class="col-lg-2 marque-judul">
                INFORMASI TERKINI:
            </div>
            <div class="col-lg-10 d-flex align-items-center">
                    <marquee behavior="scroll" direction="left" scrollamount="5">
                <?php 
                foreach ($pesan_singkat as $key => $value) {
                    echo ' '.$value['konten'].' '; 
                }
                ?> 
                    </marquee>
                </div>
            </div>
        </div>
    </div>