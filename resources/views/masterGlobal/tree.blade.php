{{--Tree Css Style--}}
<style type="text/css">
    .tree {
        min-height:20px;
        padding:17px;
        margin-bottom:20px;
        background-color:#fbfbfb;
        border:1px solid #999;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
        border-radius:4px;
        -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
        -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
    }
    .tree li {
        list-style-type:none;
        /*margin:0;*/
        padding:10px 5px 0 5px;
        position:relative;
        /*Customize*/
        margin-top: -4px;
        margin-left: 2px;
    }
    .tree li::before, .tree li::after {
        content:'';
        left:-20px;
        position:absolute;
        right:auto
    }
    .tree li::before {
        border-left:1px solid #999;
        bottom:50px;
        height:100%;
        top:0;
        width:1px;
        /*Customize*/
        margin-top:-2px;
    }
    .tree li::after {
        border-top:1px solid #999;
        height:20px;
        top:25px;
        width:25px
    }
    .tree li span {
        -moz-border-radius:5px;
        -webkit-border-radius:5px;
        border:1px solid #999;
        height: 25px;
        border-radius:5px;
        display:inline-block;
        padding:5px 8px;
        text-decoration:none
    }
    .tree li.parent_li>span {
        cursor:pointer
    }
    .tree>ul>li::before, .tree>ul>li::after {
        border:0
    }

    .tree li:last-child::before {
        height:30px
    }

    .tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
        background:#eee;
        border:1px solid #94a0b4;
        color:#000
    }
    .col-sm-6 .form-group{
        clear: both !important;
        margin-bottom: 10px !important;
    }
    .view_org_style{
        margin-top: 5px !important;
    }

    .markButton {
        background: #637C37;
        color: white;
        padding: 4px 10px;
    }

    .mouseHoverHand {
        cursor: pointer;
    }

    .mouseHoverHand:hover {
        color: #556A2F;
    }
    .workFlowOrganization{
        margin-top: 25px;
    }
    .new_org_wrapper{
        display: none;

    }
    .workFlowOrganization{ display: none; }
    .btn-xs{
        padding: 4px;
        font-size: 11px;
    }

</style>