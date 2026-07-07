<style>
    .container-fluid{
        padding:0px 0px 10px 0px;
    }
    #map{
        width: 100%;
        height: 500px;
    } 
    .leaflet-control-container .leaflet-control #controlbox{ 
        top: -4px;
    } 
    .leaflet-control-container .leaflet-control #controlbox #boxcontainer div:nth-child(2){ 
        margin-top: 3px!important;
    } 
    .leaflet-control-container .leaflet-control .panel{  
        background: rgba(255,255,255,0.95)!important;  
        margin-top: 10px!important;
    } 
    .leaflet-control-container .leaflet-control .panel .panel-header{  
        border-bottom: 2px solid rgba(255,235,200,0.9)!important;
        border-right: 2px solid rgba(255,235,200,0.9)!important;
    }
    .leaflet-control-container .leaflet-control .panel .panel-header .panel-header-container{ 
        background: #e87a37!important;
    } 
    .leaflet-control-container .leaflet-control .panel .panel-header .panel-header-container .panel-header-title{ 
        color           : #FFF!important;
        font-size       : 18px!important;
        line-height     : 24px!important;
        padding-top     : 13px!important;
        padding-bottom  : 13px!important;
    } 
    .leaflet-control-container .leaflet-control .panel .panel-content ul.panel-list li.panel-list-item{ 
        padding: 0px!important;
    } 
    .leaflet-control-container .leaflet-control .panel .panel-content ul.panel-list li.panel-list-item button{ 
        color: #444!important;
    }  
    .leaflet-control-container .leaflet-control .panel .panel-content ul.panel-list li.panel-list-item button:hover{ 
        color: #e87a37!important;
    } 
    #tabel_pesebaran tr td{  
         padding: 5px 5px 5px 5px;
         box-shadow: none!important;
    } 
    @media(max-width: 780px){
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer.searchbox{ 
            background  : rgba(255,255,255,0.9);
            width       : 320px!important;
            height      : 60px; 
            padding     : 15px 50px 15px; 
            margin-left : 10px;
        }  
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer .searchbox-menu-container {
            left: 0;
            top: 6px;
        }
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer div:nth-child(2){ 
            margin-top: 5px!important;
        } 
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer .searchbox-searchbutton-container, 
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer .searchbox-searchbutton-container::after {
            right: 0;
            top: 15px;
        } 

    }
    @media(max-width: 360px){
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer.searchbox{  
            width   : 290px!important; 
        }
    }
    @media(max-width: 320px){
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer.searchbox{  
            width   : 260px!important; 
        }
    }
</style> 
     <section class="white-wrapper" style="padding: 10px 0 0 0;">
        <div class="container">
            <div class="general-title">
                <h2>Peta Persebaran Titik Bencana</h2>
                <hr>
            </div><!-- end general title -->
        </div><!-- end container -->
        <div id="map" style="margin-top: 20px;"></div>
        <div class="clearfix"></div>  
    </section>
        