$d = jQuery.noConflict();
var isProcessingSomething = false;

$d(function () {

    $d("#MaskForDropDown").css({
        height: $d(document).height() + "px",
        width: $d(document).width() + "px",
    });

    $d(".liSchoolItem:eq(0)").addClass("isSelected");
//    $d(".liSchoolItem").hover(function () {   
//        $d(this).addClass("isSelected").siblings().removeClass("isSelected");
//        //$d(this).focus();
//    });          

    $d("#MaskForDropDown").click(function () {
        $d("#divScon").slideUp("fast");
        $d(this).css("display", "none");
        $d(".divDropLists, #divSchools").attr("isActive", "0");
    });

    $d(".divDropLists, #divSchools").click(function () {
        if($d(this).attr("isActive") == "0") {
            $d("#divScon").slideDown("fast");
            $d("#MaskForDropDown").css("display", "block");
            $d(this).attr("isActive", "1");
        } else {            
            $d("#MaskForDropDown").click();
        }

//        $d(".lischoolitem").focus(function(){            
//            $d(this).addclass("isselected").siblings().removeclass("isselected");
//            var index = $d(this).index()
//            var oheight = $d(this).outerheight()
//            //$d(this).parent().scrolltop((index * oheight) + oheight);
//        }).hover(function () {   
//            $d(this).addclass("isselected").siblings().removeclass("isselected");
//            //$d(this).focus();
//        }).keydown(function(e){
//            var self = $d(this);
//            if (e.keycode == 40) {
//                self.blur();
//                self.next().focus();
//                return false;
//            } else if (e.keycode == 38){
//                self.blur();
//                self.prev().focus();
//                return false;
//            }

//        }).first().focus();
    });


    $d(document).on('click', '.liSchoolItem', function(){
        var school = $d(this).find("span").text().replace(/\s/g, '-').toLowerCase();
        window.location.href = "/school/" + school;
    });

    $d(document).on('mouseover', '.liSchoolItem', function(){
        $d(this).addClass("isSelected").siblings().removeClass("isSelected");
    });

    $d("#ulScon").bind("mousewheel DOMMouseScroll", function (e) {
        var f = e.originalEvent,
            g = f.wheelDelta || -f.detail;

        this.scrollTop += ( g < 0 ? 1 : -1 ) * 30;
        e.preventDefault();        
    });

    $d(".divSearch").click(function(){
         if($d(this).prev().val().replace(/^\s|\s$/g, "") != "") {
              window.location.href = "/school/" + encodeURIComponent($d(this).prev().val().replace(/^\s|\s$/g, "-"));
          }
    });

    $d(".txtSchools").bind("keypress", function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);

        if(code == 13) { //Enter keycode
          e.preventDefault();
          if($d(this).val().replace(/^\s|\s$/g, "") != "")
          {
              window.location.href = "/school/" + encodeURIComponent($d(this).val().replace(/^\s|\s$/g, "-"));
          }
        }
    
    });

//    $d(".txtSchools").bind("keyup", function(e) {    

//        $d("#ulScon").html("");
//        
//                                 
//        var hdnAllSchool = $d("input[id*='hdnAllSchool']").val().split("|");
//        var scFiltered;
//        
//        scFiltered = hdnAllSchool.filter(scFilter);
//        
//        var liSchoolItem = "liSchoolItem";
//        var i;

//        for(i = 0;i < scFiltered.length ;i++) {     
//         
//            if (scFiltered[i].replace(/^\s|\s$/g, "") == "") {
//                $d(".liSchoolItem:eq(0)").addClass("isSelected");
//                return false;
//            }  

//            //var school = scFiltered[i].replace(/\s/g, '-').toLowerCase();
//            //var schoolLink = "/school.aspx?cat=" + school;
//                  
//            liSchoolItem += i.toString();
//            $d("#ulScon").append("<li id='" + liSchoolItem + "' class='liSchoolItem'><span class='lblSchool'>" + scFiltered[i] + "</span></li>") 
//            liSchoolItem = "liSchoolItem";                   
//        }

//        $d(".liSchoolItem:eq(0)").addClass("isSelected");
//        
//    });


    //webbI: comment for now 4mar2015
    //function for filter
//    var scFilter = function(el) {
//        return (el.startsWith($d(".txtSchools").val().toUpperCase()));
//    }
    //end function

});

//if (typeof String.prototype.startsWith != 'function') {
//  String.prototype.startsWith = function (str){
//    return this.indexOf(str) == 0;
//  };
//}
