<?php
session_start();
$pageTitle = "Enrollment";
include './includes/header.php';
require_once './config/database.php';
require_once 'includes/functions.php';

// if (isLoggedIn()) {
//     if (hasRole('teacher')) {
//         header('Location: teacher/dashboard.php');
//         exit;
//     }
// } else {
//     header('Location: login.php');
// }

?>

    <div class="d-flex justify-content-center align-items-center gap-4 py-3" style="background-color: #2A5A7F;">
        <a href="index.php">
            <img src="./assets/images/cropMainCDC.png" class="enroll-header-img" width="125" height="125" alt="cdc">
        </a>
        <div class="text-center">
            <p class="text-white">CHILD DEVELOPMENT CENTER MANAGEMENT SYSTEM</p>
            <p class="text-white">ENROLLMENT PROCESS</p>
        </div>

        <img src="./assets/images/logo.png" class="enroll-header-img" width="100" height="100" alt="logo">
    </div>

    <div class="container bg-enrollment p-4 my-4 rounded">
        <div class="">
            <h5 class="fw-bold">Application Process</h5>
            <p>
                The Child Development Center's online application process is simple, secure and convenient. You can start filling out your application now, save your progress, and complete it at your convenience. Once registered, you will receive a Student ID Number. 
            </p>
        </div>
        
        <div class="mt-4">
            <h5 class="fw-bold">Basic Requirements</h5>
            <ul>
                <li>Your child meets the age requirement for enrollment</li>
                <li>You can provide a copy of your child's PSA</li>
                <li>Your child's immunizations are up to date</li>
                <li>You have emergency contact details ready</li>
            </ul>
        </div>

        <div class="mt-4">
            <h5 class="fw-bold">NOTES</h5>
            <ul>
                <li>Fields with asterisk (*) are required.</li>
                <li>Requirements without an (*) can be submitted online through the Portal.</li>
                <li>Put a WORKING email, student number will be sent to your email.</li>
            </ul>
        </div>
    </div>

    <!-- Form Start -->
    <form id="enrollmentForm" method="POST" enctype="multipart/form-data">
        <div class="container bg-enrollment p-4 my-4 rounded">
            <div class="">
                <h5 class="fw-bold">STUDENT BASIC INFORMATION</h5>
                <div class="row mt-2">
                    <div class="col">
                        <label for="lName"><span class="text-danger">*</span>Last Name</label>
                        <input type="text" class="form-control" id="lName" name="lName" required>
                    </div>
                    <div class="col">
                        <label for="fName"><span class="text-danger">*</span>First Name</label>
                        <input type="text" class="form-control" id="fName" name="fName" required>
                    </div>
                    <div class="col">
                        <label for="mName"><span class="text-danger">*</span>Middle Name</label>
                        <input type="text" class="form-control" id="mName" name="mName" required>
                    </div>
                    <div class="col">
                        <label for="suffix">Suffix</label>
                        <input type="text" class="form-control" id="suffix" name="suffix">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="bDay"><span class="text-danger">*</span>Birth Date</label>
                        <input type="date" class="form-control" id="bDay" name="bDay" value="2020-01-01" min="2020-01-01" required>
                    </div>
                    <div class="col">
                        <label for="age"><span class="text-danger">*</span>Age</label>
                        <input type="number" class="form-control" id="age" name="age" readonly required>
                    </div>
                    <div class="col">
                        <label for="sex"><span class="text-danger">*</span>Sex</label>
                        <select class="form-control" id="sex" name="sex" required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="healthHistory">Health History</label>
                        <input type="text" class="form-control" id="healthHistory" name="healthHistory">
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <h5 class="fw-bold">ADDRESS</h5>
                <div class="row row-cols-4 mt-2">
                    <div class="col">
                        <label for="addressNumber"><span class="text-danger">*</span>Address Number</label>
                        <input type="text" class="form-control" id="addressNumber" name="addressNumber" required>
                    </div>
                    <div class="col">
                        <label for="brgy"><span class="text-danger">*</span>Barangay</label>
                        <input type="text" class="form-control" id="brgy" name="brgy" required>
                    </div>
                    <div class="col">
                        <label for="municipality"><span class="text-danger">*</span>Municipality</label>
                        <input type="text" class="form-control" id="municipality" name="municipality" value="Quezon City" readonly required>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <h5 class="fw-bold">PARENTS/GUARDIAN INFORMATION</h5>
                <p class="fw-bold mt-3">Father's Information</p>
                <div class="row">
                    <div class="col">
                        <label for="fatherLName"><span class="text-danger">*</span>Last Name</label>
                        <input type="text" class="form-control" id="fatherLName" name="fatherLName" required>
                    </div>
                    <div class="col">
                        <label for="fatherFName"><span class="text-danger">*</span>First Name</label>
                        <input type="text" class="form-control" id="fatherFName" name="fatherFName" required>
                    </div>
                    <div class="col">
                        <label for="fatherMName">Middle Name</label>
                        <input type="text" class="form-control" id="fatherMName" name="fatherMName">
                    </div>
                    <div class="col">
                        <label for="fatherContactNo"><span class="text-danger">*</span>Contact Number</label>
                        <input type="tel" class="form-control" id="fatherContactNo" maxlength="11" name="fatherContactNo" required>
                    </div>
                </div>
                
                <p class="fw-bold mt-3">Mother's Maiden Name</p>
                <div class="row">
                    <div class="col">
                        <label for="motherLName"><span class="text-danger">*</span>Last Name</label>
                        <input type="text" class="form-control" id="motherLName" name="motherLName" required>
                    </div>
                    <div class="col">
                        <label for="motherFName"><span class="text-danger">*</span>First Name</label>
                        <input type="text" class="form-control" id="motherFName" name="motherFName" required>
                    </div>
                    <div class="col">
                        <label for="motherMName">Middle Name</label>
                        <input type="text" class="form-control" id="motherMName" name="motherMName">
                    </div>
                    <div class="col">
                        <label for="motherContactNo"><span class="text-danger">*</span>Contact Number</label>
                        <input type="tel" class="form-control" id="motherContactNo" maxlength="11" name="motherContactNo" required>
                    </div>
                </div>

                <p class="fw-bold mt-4">Guardian's Information</p>
                <div class="row mb-3">
                    <div class="col">
                        <span class="text-danger">*</span>Guardian is:
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="guardian_type" id="guardian_father" value="father" checked>
                            <label class="form-check-label" for="guardian_father">Father</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="guardian_type" id="guardian_mother" value="mother">
                            <label class="form-check-label" for="guardian_mother">Mother</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="guardian_type" id="guardian_other" value="other">
                            <label class="form-check-label" for="guardian_other">Other</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="guardianLName"><span class="text-danger">*</span>Last Name</label>
                        <input type="text" class="form-control" id="guardianLName" name="guardianLName" required>
                    </div>
                    <div class="col">
                        <label for="guardianFName"><span class="text-danger">*</span>First Name</label>
                        <input type="text" class="form-control" id="guardianFName" name="guardianFName" required>
                    </div>
                    <div class="col">
                        <label for="guardianMName">Middle Name</label>
                        <input type="text" class="form-control" id="guardianMName" name="guardianMName">
                    </div>
                    <div class="col">
                        <label for="guardianContactNo"><span class="text-danger">*</span>Contact Number</label>
                        <input type="tel" class="form-control" id="guardianContactNo" maxlength="11" name="guardianContactNo" required>
                    </div>
                </div>
                <div class="row row-cols-4 mt-3">
                    <div class="col">
                        <label for="guardianRelationship"><span class="text-danger">*</span>Relationship</label>
                        <input type="text" class="form-control" id="guardianRelationship" name="guardianRelationship" required>
                    </div>
                    <div class="col">
                        <label for="guardianEmail"><span class="text-danger">*</span>Email</label>
                        <input type="email" class="form-control" id="guardianEmail" name="guardianEmail" required>
                    </div>
                    <div class="col">
                        <label for="guardianOccupation"><span class="text-danger">*</span>Occupation</label>
                        <input type="text" class="form-control" id="guardianOccupation" name="guardianOccupation" required>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h5 class="fw-bold">ENROLLMENT INFORMATION</h5>
                <div class="row row-cols-4">
                    <div class="col">
                        <label for="schedule"><span class="text-danger">*</span>Schedule</label>
                        <select class="form-control" id="schedule" name="schedule" required>
                            <option value="">Select</option>
                            <option value="K1">K1 (3y/o) - 8:00am - 10:00am</option>
                            <option value="K2">K2 (4y/o) - 10:15am - 12:15nn</option>
                            <option value="K3">K3 (4y/o) - 1:30pm - 3:30pm</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h5 class="fw-bold">REQUIREMENTS</h5>
                <div class="row row-cols-4">
                    <div class="col">
                        <label for="psa"><span class="text-danger">*</span>PSA Birth Certificate</label>
                        <input type="file" class="form-control" id="psa" name="psa" required>
                    </div>
                    <div class="col">
                        <label for="immunizationCard">Immunization Card</label>
                        <input type="file" class="form-control" id="immunizationCard" name="immunizationCard">
                    </div>
                    <div class="col">
                        <label for="recentPhoto">Recent Photo</label>
                        <input type="file" class="form-control" id="recentPhoto" name="recentPhoto">
                    </div>
                    <div class="col">
                        <label for="guardianQCID"><span class="text-danger">*</span>Guardian's QC ID</label>
                        <input type="file" class="form-control" id="guardianQCID" name="guardianQCID" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary d-block w-100 mt-5">Submit</button>
        </div>
    </form>

</div>

<script>

    document.addEventListener("DOMContentLoaded", () => {
        // Get the enrollment form
        const enrollmentForm = document.getElementById("enrollmentForm")

        // Add submit event listener to the form
        enrollmentForm.addEventListener("submit", function (e) {
        e.preventDefault() // Prevent default form submission

        // Create FormData object from the form
        const formData = new FormData(this)

        // Show loading state
        Swal.fire({
            title: "Submitting...",
            text: "Please wait while we process your enrollment.",
            allowOutsideClick: false,
            didOpen: () => {
            Swal.showLoading()
            },
        })

        // Submit the form using fetch API
        fetch("./enrollment_process/database_process.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
            // Check if the response is ok
            if (!response.ok) {
                throw new Error("Network response was not ok")
            }
            return response.json()
            })
            .then((data) => {
            // Handle successful response
            if (data.status === "success") {
                Swal.fire({
                icon: "success",
                title: "Success",
                text: data.message || "Enrollment submitted successfully!",
                confirmButtonText: "OK",
                confirmButtonColor: "#28a745",
                }).then(() => {
                // Redirect to index.php after clicking OK
                window.location.href = "./index.php"
                })
            } else {
                // Handle error response from server
                Swal.fire({
                icon: "error",
                title: "Error",
                text: data.message || "Something went wrong. Please try again.",
                confirmButtonText: "OK",
                confirmButtonColor: "#dc3545",
                })
            }
            })
            .catch((error) => {
            // Handle network errors or JSON parsing errors
            console.error("Error:", error)
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Unable to process the request. Please check your connection.",
                confirmButtonText: "OK",
                confirmButtonColor: "#dc3545",
            })
            })
        })


        const guardianTypeRadios = document.querySelectorAll('input[name="guardian_type"]')
        const bDayInput = document.getElementById("bDay")
        const ageInput = document.getElementById("age")
        const municipality = document.getElementById("municipality")

        const guardianFields = {
            LName: document.getElementById("guardianLName"),
            FName: document.getElementById("guardianFName"),
            MName: document.getElementById("guardianMName"),
            ContactNo: document.getElementById("guardianContactNo"),
        }
        const fatherFields = {
            LName: document.getElementById("fatherLName"),
            FName: document.getElementById("fatherFName"),
            MName: document.getElementById("fatherMName"),
            ContactNo: document.getElementById("fatherContactNo"),
        }
        const motherFields = {
            LName: document.getElementById("motherLName"),
            FName: document.getElementById("motherFName"),
            MName: document.getElementById("motherMName"),
            ContactNo: document.getElementById("motherContactNo"),
        }

        function updateGuardianFields(guardianType) {
            console.log("Guardian type changed to:", guardianType)

            const sourceFields = guardianType === "father" ? fatherFields : guardianType === "mother" ? motherFields : null

            for (const field in guardianFields) {
            if (sourceFields && sourceFields[field]) {
                guardianFields[field].value = sourceFields[field].value || ""
                guardianFields[field].readOnly = guardianType === "father" || guardianType === "mother"
            } else {
                guardianFields[field].value = ""
                guardianFields[field].readOnly = false
            }
            }

            // Update relationship field
            const relationshipField = document.getElementById("guardianRelationship")
            if (relationshipField) {
            if (guardianType === "father") {
                relationshipField.value = "Father"
                relationshipField.readOnly = true
            } else if (guardianType === "mother") {
                relationshipField.value = "Mother"
                relationshipField.readOnly = true
            } else {
                relationshipField.value = ""
                relationshipField.readOnly = false
            }
            }
        }

        // Add event listeners to parent fields to update guardian fields if already selected
        function addParentFieldListeners(parentFields, guardianType) {
            for (const field in parentFields) {
            if (parentFields[field]) {
                parentFields[field].addEventListener("input", () => {
                const selectedGuardian = document.querySelector('input[name="guardian_type"]:checked')
                if (selectedGuardian && selectedGuardian.value === guardianType) {
                    updateGuardianFields(guardianType)
                }
                })
            }
            }
        }

        // Add listeners to parent fields
        addParentFieldListeners(fatherFields, "father")
        addParentFieldListeners(motherFields, "mother")

        // Add change event to radio buttons
        guardianTypeRadios.forEach((radio) => {
            radio.addEventListener("change", function () {
            console.log("Radio changed:", this.value)
            updateGuardianFields(this.value)
            })
        })

        // Initial update based on the default selection
        const initialGuardianType = document.querySelector('input[name="guardian_type"]:checked')
        if (initialGuardianType) {
            console.log("Initial guardian type:", initialGuardianType.value)
            updateGuardianFields(initialGuardianType.value)
        } else {
            console.log("No guardian type selected initially")
        }

        // Validate contact numbers to only allow numbers
        const validateContactNumber = function () {
            this.value = this.value.replace(/[^0-9]/g, "")
        }

        document.getElementById("motherContactNo").addEventListener("input", validateContactNumber)
        document.getElementById("guardianContactNo").addEventListener("input", validateContactNumber)
        document.getElementById("fatherContactNo").addEventListener("input", validateContactNumber)

        // Calculate age based on birthdate
        bDayInput.addEventListener("change", function () {
            const bDay = new Date(this.value)
            const today = new Date()
            let age = today.getFullYear() - bDay.getFullYear()
            const monthDiff = today.getMonth() - bDay.getMonth()

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bDay.getDate())) {
            age--
            }

            if (age >= 3 && age <= 5) {
            ageInput.value = age
            } else {
            alert("Age should be 3 or 5 years old.")
            bDayInput.value = ""
            ageInput.value = ""
            }
        })

        // Set default municipality
        municipality.value = "Quezon City"
        municipality.readOnly = true
    })
</script>

<?php include 'includes/footer.php'; ?>

