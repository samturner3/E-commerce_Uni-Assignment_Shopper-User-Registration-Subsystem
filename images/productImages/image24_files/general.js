$a = jQuery.noConflict();
var isProcessing = false;

$a(function () {


    var $Fcontent = function () {
        var $H = $a(window).height();
        var $outsideH = $a("div[id*='divFooter']").height() + $a(".divHTML").height();
        var $newH = ($H - 20) - $outsideH;

        $a(".divContentClass").css("height", $newH + "px");
    }

    $a(window).load(function () {
        $Fcontent();
    });

    $a(window).resize(function () {
        $Fcontent();
    });

    //Header

    $a("#divMyAccountHeader").hover(function () {
        $a("#divHoverMyAccount").css("display", "block");
    }, function () {
        $a("#divHoverMyAccount").css("display", "none");
    });

// hide for now 12March2015
//    $a("#divCurrenciesHeader").hover(function () {
//        $a("#divHoverCurrencies").css("display", "block");
//    }, function () {
//        $a("#divHoverCurrencies").css("display", "none");
//    });

    //Hover

    $a(".divMenuLinkContainer").hover(function () {
        if ($a(this).find("a[id*='aMenuLink']").text().toLowerCase().indexOf("shop") > -1) {
            $a(this).parents("div[id*='divMenu']").find(".schoolMenuhover").css("display", "block");

//            if ($a(".schoolMenuhover").css("display") == "none") {
//                $a(this).parents("div[id*='divMenu']").find(".schoolMenuhover").slideDown("slow");
//            }
        }

    }, function () {
        if ($a(this).find("a[id*='aMenuLink']").text().toLowerCase().indexOf("shop") > -1) {
            $a(this).parents("div[id*='divMenu']").find(".schoolMenuhover").css("display", "none");
//            if ($a(".schoolMenuhover").css("display") == "block") {
//                $a(this).parents("div[id*='divMenu']").find(".schoolMenuhover").slideUp("slow");
//            }
        }

    });

    $a("#divTemp").hover(function () {
        $a(".schoolMenuhover").css("display", "block");
    });

    $a(".schoolMenuhover").hover(function () {
        $a(this).css("display", "block");
    }, function () {
        //$a(this).slideUp();
        $a("#ulScon").scrollTop(0);
        $ResetSelectedDropdown();
        $a(this).css("display", "none");
    });

    //End hover

    $a("#divMasterMask").css({
        height: $a(document).height() + "px",
        width: $a(document).width() + "px"
    });

    $a("#divMasterMask").click(function () {
        hideMasterMask();
    });


    $a(".clickableCurrency").click(function () {
        var newCurrencyValue = "";
        newCurrencyValue += $a(this).attr("char") + $a(this).attr("code") + ":";
        newCurrencyValue += $a(this).attr("cid");
        $a("input[id*='hdnCurrency']").val(newCurrencyValue);
        $a("input[id*='hdnChangeCurrency']").val("1");
        $a("input[id*='btnMasterRefresh']").click();
    });

    $a("#spanChangeCountry").click(function () {
        showMasterMask("#divCurrencyPoup", "true");
        $a("#divCurrencyPoup").fadeIn("fast");
    });

    var $getCurrencyId = function () {
        var id = "";
        id = $a("input[id*='hdnCurrency']").val();
        id = id.substring(5);
        return id;
    }

    $a("li.liCurrency").each(function (index) {
        if ($a(this).attr("cid") == $getCurrencyId()) {
            $a(this).css("font-weight", "bold");
        }
    });

    $a("#ulScon").mousemove(function (e) {
        if ((e.pageY) >= 440 && (e.pageY) < 470) {
            $a("#ulScon").scrollTop($a("#ulScon").scrollTop() + 5);
        } else if ((e.pageY) >= 470) {
            $a("#ulScon").scrollTop($a("#ulScon").scrollTop() + 20);
        } else if ((e.pageY) >= 110 && (e.pageY) <= 125) {
            $a("#ulScon").scrollTop($a("#ulScon").scrollTop() - 5);
        } else if ((e.pageY) < 110) {
            $a("#ulScon").scrollTop($a("#ulScon").scrollTop() - 20);
        } else {
            $a("#ulScon").scrollTop();
        }
       // $a("#debugger").text(e.pageY);
    });
});

$ResetSelectedDropdown = function () {

    $a("#ulScon").find("li.liSchoolItem").each(function (index) {
        if (index == 0) {
            $a(this).attr("class", "liSchoolItem isSelected");
        } else {
            $a(this).attr("class", "liSchoolItem");
        }
    });
}
function showMasterMask(modal, isClickable) {
    $a("#divMasterMask").fadeIn("fast");
    $a("#divMasterMask").attr("clickable", isClickable);
    $a("#divMasterMask").attr("modal", modal);
}

function hideMasterMask() {
    if ($a("#divMasterMask").attr("clickable") == "true") {
        $a("#divMasterMask").fadeOut("fast");
        $a($a("#divMasterMask").attr("modal")).fadeOut("fast", function () {

//            //STOP VIDEO WHEN MASK IS CLICKED//
//            if (($a("#divMasterMask").attr("modal")) == "#divVideoContainer") {
//                $a("#frmVideoPlayer").attr("src", "");
//            }
//            //STOP VIDEO WHEN MASK IS CLICKED//

            var parentID = $a("#divMasterMask").attr("modal");
            $a(parentID + " div.divModalProgress").css("display", "none");
            $a(parentID + " div.divModalProgress:eq(0)").css("display", "block");
        });
    }
}
