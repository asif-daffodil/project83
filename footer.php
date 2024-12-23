<footer class="bg-dark text-light pt-5 pb-4">
  <div class="container">
    <div class="row">
      <!-- Company Info -->
      <div class="col-md-4">
        <h5>Company Name</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris.</p>
      </div>
      <!-- Quick Links -->
      <div class="col-md-4">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-light text-decoration-none">Home</a></li>
          <li><a href="#" class="text-light text-decoration-none">Shop</a></li>
          <li><a href="#" class="text-light text-decoration-none">About Us</a></li>
          <li><a href="#" class="text-light text-decoration-none">Contact</a></li>
        </ul>
      </div>
      <!-- Social Media Links -->
      <div class="col-md-4">
        <h5>Follow Us</h5>
        <div class="d-flex">
          <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
          <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-light me-3"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>
    <!-- Copyright -->
    <div class="text-center mt-4">
      <p>&copy; 2024 Company Name. All Rights Reserved.</p>
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  const cartCount = () => {
    if (localStorage.getItem('ghaziCart')) {
      let cart = JSON.parse(localStorage.getItem('ghaziCart'));
      let count = cart.reduce((acc, p) => acc + p.qty, 0);
      document.querySelector('#cartCount').innerText = count;
      if (count > 0) {
        document.querySelector('#checkoutBtn').classList.remove('d-none');
      } else {
        document.querySelector('#checkoutBtn').classList.add('d-none');
      }
    }


  }
  cartCount();
  // #cartList is the id of the div where we will show the cart items
  $('#offcanvasRight').on('show.bs.offcanvas', function() {
    if (localStorage.getItem('ghaziCart')) {
      let cart = JSON.parse(localStorage.getItem('ghaziCart'));
      $.post('ajax/cart-list.php', {
        cart
      }, (data) => {
        $('#cartList').html(data);
      });
    } else {
      $('#cartList').html('<h5 class="text-center">Cart is empty</h5>');
    }
  });

  const removeFromCart = (pid) => {
    // remove the product from the localStorage
    let cart = JSON.parse(localStorage.getItem('ghaziCart'));
    let newCart = cart.filter(p => p.id != pid);
    localStorage.setItem('ghaziCart', JSON.stringify(newCart));
    cartCount();
    // remove the product from the cart list
    $.post('ajax/cart-list.php', {
      cart: newCart
    }, (data) => {
      $('#cartList').html(data);
    });
    $.post('ajax/checkout.php', {
      cart
    }, (data) => {
      $('#cartProducts').html(data);
    });
    // show a success message on toastr
    toastr["success"]("Product removed from cart successfully!");
  }

  const decreaseQty = pid => {
    let cart = JSON.parse(localStorage.getItem('ghaziCart'));
    let found = cart.find(p => p.id == pid);
    if (found.qty > 1) {
      found.qty--;
      localStorage.setItem('ghaziCart', JSON.stringify(cart));
      cartCount();
      $.post('ajax/cart-list.php', {
        cart
      }, (data) => {
        $('#cartList').html(data);
      });
      $.post('ajax/checkout.php', {
        cart
      }, (data) => {
        $('#cartProducts').html(data);
      });
    }
  }

  const increaseQty = pid => {
    let cart = JSON.parse(localStorage.getItem('ghaziCart'));
    let found = cart.find(p => p.id == pid);
    if (found.qty >= 1) {
      found.qty++;
      localStorage.setItem('ghaziCart', JSON.stringify(cart));
      cartCount();
      $.post('ajax/cart-list.php', {
        cart
      }, (data) => {
        $('#cartList').html(data);
      });
      $.post('ajax/checkout.php', {
        cart
      }, (data) => {
        $('#cartProducts').html(data);
      });
    }
  }

  const addToCart = (pid) => {
    Swal.fire({
      title: 'Product added to cart successfully!',
      icon: 'success',
      showConfirmButton: true,
      confirmButtonText: 'View Cart',
      confirmButtonColor: '#007bff',
      showCloseButton: true,
      timer: 5000,
      timerProgressBar: true,
      showCancelButton: true,
      cancelButtonText: 'Continue Shopping',
      cancelButtonColor: '#359c35',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `./cart.php`;
      }
    });
    $.post('ajax/add-to-cart.php', {
      pid
    }, (data) => {
      // check if there is a localStorage item with the name 'ghaziCart' and the product id is already in the cart
      if (localStorage.getItem('ghaziCart')) {
        let cart = JSON.parse(localStorage.getItem('ghaziCart'));
        let found = cart.find(p => p.id == pid);
        if (found) {
          found.qty++;
        } else {
          cart.push({
            id: pid,
            qty: 1
          });
        }
        localStorage.setItem('ghaziCart', JSON.stringify(cart));
        cartCount();
      } else {
        localStorage.setItem('ghaziCart', JSON.stringify([{
          id: pid,
          qty: 1
        }]));
        cartCount();
      }
    });
  }

  $("#checkoutBtn").on('click', () => {
    window.location.href = './checkout.php';
  });
</script>
</body>

</html>