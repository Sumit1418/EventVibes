<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>compantdetails</title>
    <link rel="stylesheet" href="{{ asset('css/companydetails.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="company-details">
            <div class="company-details-head">
                <h2>Company Details</h2>
                <button id="large" form="myForm" type="submit" class="submit-button">
                    Submit
                </button>
                <a href="/company/dashboard"><i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="company-details-body">
                <form id="myForm" action="/company/companydetails" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="left">
                        <div class="logo-container">
                            <div class="logo">
                                <img id="logo-img" src="{{ asset('storage/' . $companyDetails->logo_path) }}"
                                    alt="Company Logo" />
                            </div>
                            <div class="logo-buttons">
                                <label for="logo-upload" class="change-logo"><i class="fa fa-pencil"></i>Change</label>
                                <input type="file" id="logo-upload" accept="image/*" name="logo_picture"
                                    onchange="previewImage(event)" hidden />
                                <div class="remove-logo">Remove</div>
                            </div>
                        </div>
                        <div class="details-left">
                            <div class="company-details-form-group">
                                <input type="text" id="owner_name" name="owner_name" placeholder="Owner Name"
                                    value="{{ $companyDetails->owner_name }}" required />
                            </div>
                            <div class="company-details-form-group">
                                <input type="email" id="email" name="email" placeholder="Email"
                                    value="{{ $company->email }}" required />
                            </div>
                            <div class="company-details-form-group">
                                <input type="tel" id="phone" name="phone" placeholder="Phone"
                                    value="{{ $companyDetails->phone }}" required />
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="details-right">
                            <div class="company-details-form-group">
                                <input type="text" id="company_name" name="company_name" placeholder="Company Name"
                                    value="{{ $companyDetails->company_name }}" required />
                            </div>
                            <div class="company-details-form-group">
                                <input type="text" id="address" name="address" placeholder="Address"
                                    value="{{ $companyDetails->address }}" required />
                            </div>
                            <div class="company-details-form-group">
                                <input type="text" id="state" name="state" placeholder="State"
                                    value="{{ $companyDetails->state }}" required />
                            </div>
                            <div class="company-details-form-group">
                                <select name="type" id="type" required>
                                    <option value="caterer">Caterer</option>
                                    <option value="decorator">Decorator</option>
                                    <option value="photographer">Photographer</option>
                                    <option value="musician">Musician</option>
                                    <option value="lighting">Lighting</option>
                                    <option value="dj">DJ</option>
                                    <option value="eventplanner">Event Planner</option>
                                </select>

                            </div>
                            <div class="company-details-form-group">
                                <input type="number" id="budget" name="budget" placeholder="Budget per day"
                                    value="{{ $companyDetails->budget }}" required />
                            </div>
                            <div class="company-details-form-group">
                                <input type="text" id="serviceable_state" name="serviceable_state"
                                    placeholder="Serviceable State" value="{{ $companyDetails->serviceable_states }}"
                                    required />
                            </div>
                            <div class="company-details-form-group">
                                <input type="number" id="serviceable_pincode" name="serviceable_pincode"
                                    placeholder="Serviceable Pincode"
                                    value="{{ $companyDetails->serviceable_pincodes }}" required />
                            </div>
                            <button id="small" form="myForm" type="submit" class="submit-button">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('logo-img');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        document.querySelector('.remove-logo').addEventListener('click', function() {
            document.getElementById('logo-img').src = ''; // Remove preview
            document.getElementById('logo-upload').value = null; // Clear file input
        });

        document.addEventListener('DOMContentLoaded', function() {
            const type = document.getElementById('type');
            const selectedType = @json($companyDetails->type);
            const options = type.options;

            for (let i = 0; i < options.length; i++) {

                if (options[i].value === selectedType) {
                    options[i].selected = true;
                }
            }
        });
    </script>
</body>

</html>
