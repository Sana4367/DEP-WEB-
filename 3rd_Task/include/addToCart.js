
function addToCart(productId) {
    var form = document.createElement("form");
    form.method = "POST";
    form.action = "add_to_cart.php";

    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "product_id";
    input.value = productId;

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();

    
}
