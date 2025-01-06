<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>userdetails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="{{ asset('css/userdetails.css') }}" />
  </head>
  <body>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible text-center">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      {{ session('success') }}
    </div>
  @endif
    <div class="container">
      <div class="user-details">
        <div class="user-details-head">
          <h2>Personal Details</h2>
          <a href="/user/home"><i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="user-details-body">
          <form action="/user/userdetails" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-container">
                <div class="profile-pic">
                    <img id="profile-img" src="{{ asset('storage/'.$userDetails->profile_path) }}" alt="Profile Picture">
                </div>
                <div class="profile-buttons">
                  <label for="image-upload" class="change-picture"><i class="fa fa-pencil"></i>Change</label>
                  <input type="file" id="image-upload" accept="image/*" name="profile_picture" onchange="previewImage(event)" hidden>
                  <div class="remove-picture">Remove</div>
                </div>
            </div>

            <div class="user-details-form">
              <div class="user-details-form-group">
                <input
                  value="{{$user->name}}"
                  type="text"
                  id="full-name"
                  name="full-name"
                  placeholder="Full Name"
                  required
                />
              </div>
              <div class="user-details-form-group">
                <input
                value="{{$user->email}}"
                  type="email"
                  id="email"
                  name="email"
                  placeholder="Email"
                  required
                />
              </div>
              <div class="user-details-form-group">
                <input
                value="{{$userDetails->phone}}"
                  type="tel"
                  id="phone"
                  name="phone"
                  placeholder="Phone"
                  required
                />
              </div>
              <div class="user-details-form-group">
                <input
                  value="{{$userDetails->address}}"
                  type="text"
                  id="address"
                  name="address"
                  placeholder="Address"
                  required
                />
              </div>
              <div class="user-details-form-group">
                <input
                  value="{{$userDetails->city}}"
                  type="text"
                  id="city"
                  name="city"
                  placeholder="City"
                  required
                />
              </div>
              <div class="user-details-form-group">
                <input
                  value="{{$userDetails->state}}"
                  type="text"
                  id="state"
                  name="state"
                  placeholder="State"
                  required
                />
              </div>
              <div class="user-details-form-group">
                <input
                  value="{{$userDetails->pincode}}"
                  type="text"
                  id="pincode"
                  name="pincode"
                  placeholder="Pincode"
                  required
                />
              </div>
              <button type="submit" class="user-details-submit">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script>

        function previewImage(event) {
          var reader = new FileReader();
          reader.onload = function () {
              var output = document.getElementById('profile-img');
              output.src = reader.result;
          };
          reader.readAsDataURL(event.target.files[0]);
        }

        document.querySelector('.remove-picture').addEventListener('click', function() {
          document.getElementById('profile-img').src = ''; // Remove preview
          document.getElementById('image-upload').value = null; // Clear file input
        });

    </script>
  </body>
</html>
