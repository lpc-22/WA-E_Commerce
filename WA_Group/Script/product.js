window.onload = function() {
    var Product_List = document.getElementById("product_list");
    var Filter_All = document.getElementById("ProductFilter_All");
    var Filter_Food = document.getElementById("ProductFilter_Food");
    var Filter_Toy = document.getElementById("ProductFilter_Toy");
    var Filter_Accessories = document.getElementById("ProductFilter_Accessories");

    Filter_All.addEventListener("click", function() {

        document.querySelectorAll("#product_list .products").forEach(child => {
            child.style.display = "block";
        });

    });

    Filter_Food.addEventListener("click", function() {

        document.querySelectorAll("#product_list .products:not(.Food)").forEach(child => {
            child.style.display = "none";
        });

        document.querySelectorAll("#product_list .Food").forEach(child => {
            child.style.display = "block";
        });

    });

    Filter_Toy.addEventListener("click", function() {

        document.querySelectorAll("#product_list .products:not(.Toy)").forEach(child => {
            child.style.display = "none";
        });

        document.querySelectorAll("#product_list .Toy").forEach(child => {
            child.style.display = "block";
        });


    });

    Filter_Accessories.addEventListener("click", function() {

        document.querySelectorAll("#product_list .products:not(.Accessories)").forEach(child => {
            child.style.display = "none";
        });

        document.querySelectorAll("#product_list .Accessories").forEach(child => {
            child.style.display = "block";
        });


    });
};