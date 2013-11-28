<style type="text/css">
.modalWindow {
        position: fixed;
        font-family: arial;
        font-size:80%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.2);
        z-index: 99999;
        opacity:0;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        pointer-events: none;
    }
    .modalHeader h2 { color: #189CDA; border-bottom: 2px groove #efefef; }
    .modalWindow:target {
        opacity:1;
        pointer-events: auto;
    }
    .modalWindow > div {
        width: 500px;
        position: relative;
        margin: 10% auto;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #fff;
    }
    .modalWindow .modalHeader  {    padding: 5px 20px 0px 20px; }
    .modalWindow .modalContent {    padding: 0px 20px 5px 20px; }
    .modalWindow .modalFooter  {    padding: 8px 20px 8px 20px; }
    .modalFooter {
        background: #F1F1F1;
        border-top: 1px solid #999;
        -moz-box-shadow: inset 0px 13px 12px -14px #888;
        -webkit-box-shadow: inset 0px 13px 12px -14px #888;
        box-shadow: inset 0px 13px 12px -14px #888;
    }
    .modalFooter p {
        color:#D4482D;
        text-align:right;
        margin:0;
        padding: 5px;
    }
    .ok, .close, .cancel {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        text-align: center;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }
    .close {
        position: absolute;
        right: 5px;
        top: 5px;
        width: 22px;
        height: 22px;
        font-size: 10px;
 
    }
    .ok, .cancel {
        width:80px;
        float:right;
        margin-left:20px;
    }
    .ok:hover { background: #189CDA; }
    .close:hover, .cancel:hover { background: #D4482D; }
    .clear { float:none; clear: both; }
    </style>
    
    <div id="openModal" class="modalWindow">
    <div>
         
        <div class="modalHeader">
            <h2>This is a sample modal window</h2>
            <a href="#close" title="Close" class="close">X</a>
        </div>
         
        <div class="modalContent">
            <p>This is a sample modal window that can be created using CSS3 and HTML5.</p>
            <p>Modal windows are used, among many others, to display login/register forms; advertisements; or just notifications to the user. They frequently contain critical information, that user must attend in order to return to the page.</p>
        </div>
         
        <div class="modalFooter">
            <a href="#cancel" title="Cancel" class="cancel">Cancel</a>
            <a href="#ok" title="Ok" class="ok">Apply</a>
            <p>Keep in mind that this is a demo</p>
            <div class="clear"></div>
        </div>
    </div>
</div>