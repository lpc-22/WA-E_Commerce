
window.onload = function() {

    //*******************FILTERING*******************//

    var Filter_All = document.getElementById("ProductFilter_All");
    var Filter_Food = document.getElementById("ProductFilter_Food");
    var Filter_Toy = document.getElementById("ProductFilter_Toy");
    var Filter_Accessories = document.getElementById("ProductFilter_Accessories");

    Filter_All.addEventListener("click", function() {

        document.querySelectorAll("#product_list .products").forEach(child => {
            child.style.display = "block";
        });

        Filter_All.classList.add("active");
        Filter_Food.classList.remove("active");
        Filter_Toy.classList.remove("active");
        Filter_Accessories.classList.remove("active");

    });

    Filter_Food.addEventListener("click", function() {

        document.querySelectorAll("#product_list .products:not(.Food)").forEach(child => {
            child.style.display = "none";
        });

        document.querySelectorAll("#product_list .Food").forEach(child => {
            child.style.display = "block";
        });

        Filter_Food.classList.add("active");
        Filter_All.classList.remove("active");
        Filter_Toy.classList.remove("active");
        Filter_Accessories.classList.remove("active");        

    });

    Filter_Toy.addEventListener("click", function() {

        document.querySelectorAll("#product_list .products:not(.Toy)").forEach(child => {
            child.style.display = "none";
        });

        document.querySelectorAll("#product_list .Toy").forEach(child => {
            child.style.display = "block";
        });

        Filter_Toy.classList.add("active");
        Filter_Food.classList.remove("active");
        Filter_All.classList.remove("active");
        Filter_Accessories.classList.remove("active");
    });

    Filter_Accessories.addEventListener("click", function() {

        document.querySelectorAll("#product_list .products:not(.Accessories)").forEach(child => {
            child.style.display = "none";
        });

        document.querySelectorAll("#product_list .Accessories").forEach(child => {
            child.style.display = "block";
        });

        Filter_Accessories.classList.add("active");
        Filter_Food.classList.remove("active");
        Filter_Toy.classList.remove("active");
        Filter_All.classList.remove("active");
    });


};    


//*******************SEARCHING*******************//
function SearchingProduct(){

    var Filter_All_Button = document.getElementById("ProductFilter_All");
    var Filter_Food_Button = document.getElementById("ProductFilter_Food");
    var Filter_Toy_Button = document.getElementById("ProductFilter_Toy");
    var Filter_Accessories_Button = document.getElementById("ProductFilter_Accessories");


    //Searching products within filtered product list.
    if(Filter_All_Button.classList.contains("active")){

        var productList = document.getElementsByClassName('products');

    }else if(Filter_Food_Button.classList.contains("active")){

        var productList = document.getElementsByClassName('Food');

    }else if(Filter_Toy_Button.classList.contains("active")){

        var productList = document.getElementsByClassName('Toy');

    }else if(Filter_Accessories_Button.classList.contains("active")){

        var productList = document.getElementsByClassName('Accessories');
    }

    var query = document.getElementById('productSearchingBar').value.toUpperCase();

    //Loop through all products
    for (var i = 0; i < productList.length; i++) {

        var currentProductName = productList[i].getElementsByTagName("h5")[0].innerText;

        //Hide those don't match the search query
        if (currentProductName.toUpperCase().indexOf(query) == -1) {
            productList[i].style.display = "none";
        }else{
            productList[i].style.display = "";
        }
    }

}
