$(document).ready(function() {
    $("#searchForm").submit(function(e) {
        e.preventDefault();

        const myNode = document.getElementsByClassName("results")[0];
        while (myNode.firstChild) {
            myNode.removeChild(myNode.lastChild);
        }

        const $form = $(this),
            sexe = $form.find("select[name='sexe']").val(),
            age = $form.find("select[name='age']").val(),
            cities = $form.find("select[id='cities']").val(),
            hobbies = $form.find("select[id='hobbies']").val();

        const posting = $.post("App/api/Search.php", {sexe: sexe, age: age, cities: cities, hobbies: hobbies}, "json");

        posting.done(function(data) {
            console.log(data);
            let json = $.parseJSON(data);
            $.each(json, function( key, val ) {
                $('.results').append("<div class=\"col-3 cards\">\n" +
                "    <div class=\"card\">\n" +
                "        <div class=\"card-body\">\n" +
                "            <h5 class=\"card-title\">" + val['lastname'] + " " + val['firstname'] + "</h5>\n" +
                "            <h6 class=\"card-subtitle mb-2 text-muted\">" + val['age'] + " ans</h6>\n" +
                "            <a href=\"index.php?action=conversation&method=new&id_recipient=" + val['id'] + "\" class=\"card-link\">Contact</a>\n" +
                "        </div>\n" +
                "    </div>\n" +
                "</div>");
            });
        });
    });

    $("#hobby").change(function() {
       if($(this).val() == "Autre") {
           $(".space-line-form").css({ display: "none" });
           $(".selectHobby").css({ display: "none" });
           $(".space-line-form-none").css({ display: "block" });
           $(".hobby").css({ display: "block" });
       }
    });
});