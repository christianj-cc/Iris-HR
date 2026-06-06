

// ------------------------ SESSION TIME OUT (10 MINS) ------------------------
let warningTimeout;
let logoutTimeout;

function resetWarningTimer() {
    clearTimeout(warningTimeout);
    clearTimeout(logoutTimeout);
    
    // Warning after 25 minutes
    warningTimeout = setTimeout(showSessionWarning, 1 * 60 * 1000); // 15 mins timeout
    
    // Auto logout after 30 minutes
    logoutTimeout = setTimeout(autoLogout, 6 * 60 * 1000);
}

function showSessionWarning() {
    if (confirm('Your session will expire in 5 minutes due to inactivity. Do you want to continue?')) {
        // Extend session
        fetch('extend-session.php')
            .then(() => {
                resetWarningTimer();
            })
            .catch(() => {
                window.location.href = '../DATABASE/db_signout.php'; 
            });
    } else {
        window.location.href = '../DATABASE/db_signout.php'; 
    }
}

function autoLogout() {
    alert('Your session has expired. You will be redirected to the login page.');
    window.location.href = 'DATABASE/db_signout.php'; 
}

// Reset timer on user activity
document.addEventListener('mousemove', resetWarningTimer);
document.addEventListener('keypress', resetWarningTimer);
document.addEventListener('click', resetWarningTimer);

// Start timer when page loads
document.addEventListener('DOMContentLoaded', resetWarningTimer);



// ------------------------ PEEK PASSWORD FUNCTION ------------------------
function togglePassword() {
    var passwordField = document.getElementById("password");
    var eyeIcon = document.getElementById("eyeIcon");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.src = "ASSETS/ICONS/eye-open.svg";
    } else {
        passwordField.type = "password";
        eyeIcon.src = "ASSETS/ICONS/eye-close.svg";
    }
}       

// ------------------------ USER DROPDOWN FUNCTION ------------------------
$(document).ready(function () {
    $("#user-icon").click(function (event) {
        event.stopPropagation(); // Prevents click from triggering the document click
        $("#dropdown-menu").toggle(); // Show/hide dropdown on click
    });

    $(document).click(function (event) {
        if (!$(event.target).closest('.user-dropdown').length) {
            $("#dropdown-menu").hide(); // Hide dropdown if clicking outside
        }
    });
});

// ------------------------ TASK LIST FUNCTION ------------------------
document.addEventListener("DOMContentLoaded", function() {
    const taskList = document.getElementById("task-list");
    const newTaskInput = document.getElementById("new-task");
    const addTaskButton = document.getElementById("add-task");

    // Load saved tasks from localStorage
    function loadTasks() {
        const tasks = JSON.parse(localStorage.getItem("tasks")) || [];
        taskList.innerHTML = "";
        tasks.forEach(task => {
            addTaskToDOM(task.text, task.completed);
        });
    }

    // Add task to the DOM
    function addTaskToDOM(text, completed = false) {
        const li = document.createElement("li");

        // Checkbox
        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.checked = completed;

        // Task text
        const taskText = document.createElement("span");
        taskText.textContent = text;
        if (completed) taskText.style.textDecoration = "line-through";

        // Remove button
        const removeBtn = document.createElement("button");
        removeBtn.textContent = "✖";
        removeBtn.classList.add("remove-task");

        // Checkbox event
        checkbox.addEventListener("change", function() {
            taskText.style.textDecoration = this.checked ? "line-through" : "none";
            saveTasks();
        });

        // Remove task event
        removeBtn.addEventListener("click", function() {
            li.remove();
            saveTasks();
        });

        // Edit task event
        taskText.addEventListener("click", function () {
            const input = document.createElement("input");
            input.type = "text";
            input.value = taskText.textContent;
            input.classList.add("edit-task");

            // Replace span with input
            li.replaceChild(input, taskText);
            input.focus();

            // Save edited text on blur or Enter key
            function saveEdit() {
                taskText.textContent = input.value.trim() || taskText.textContent;
                li.replaceChild(taskText, input);
                saveTasks();
            }

            input.addEventListener("blur", saveEdit);
            input.addEventListener("keypress", function (event) {
                if (event.key === "Enter") {
                    saveEdit();
                }
            });
        });

        // Append elements
        li.appendChild(checkbox);
        li.appendChild(taskText);
        li.appendChild(removeBtn);
        taskList.appendChild(li);
    }

    // Save tasks to localStorage
    function saveTasks() {
        const tasks = [];
        document.querySelectorAll("#task-list li").forEach(li => {
            tasks.push({
                text: li.querySelector("span").textContent,
                completed: li.querySelector("input").checked
            });
        });
        localStorage.setItem("tasks", JSON.stringify(tasks));
    }

    // Add new task
    addTaskButton.addEventListener("click", function() {
        const text = newTaskInput.value.trim();
        if (text !== "") {
            addTaskToDOM(text);
            saveTasks();
            newTaskInput.value = "";
        }
    });

    loadTasks();
});

// ------------------------ SIDEBAR FUNCTION ------------------------
document.addEventListener("DOMContentLoaded", function() {

    const menuToggle = document.getElementById("menu-toggle");
    const sidebar = document.querySelector(".sidebar");
    const mainContent = document.querySelector(".main-content");
    const logoSmall = document.querySelector(".logo-s");
    const logoFull = document.querySelector(".logo-f");

    function toggleSidebar() {
        let screenWidth = window.innerWidth; // Get the current screen width
        
        if (screenWidth <= 1100) { 
            // For small screens (mobile/tablet)
            if (sidebar.style.display === "flex") {
                sidebar.style.display = "none"; // Hide sidebar
                mainContent.style.marginLeft = "20px";
            } else {
                sidebar.style.display = "flex"; // Show sidebar
                logoSmall.style.display = "block";
                mainContent.style.marginLeft = "150px";
            }
        } else { 
            // For larger screens
            if (sidebar.style.display === "flex") {
                sidebar.style.display = "none"; // Hide sidebar
                mainContent.style.marginLeft = "20px";
            } else {
                sidebar.style.display = "flex"; // Show sidebar
                mainContent.style.marginLeft = "295px";
            }
        }
    }

    // Toggle sidebar when clicking menu button
    menuToggle.addEventListener("click", toggleSidebar);

    // Ensure sidebar adapts on window resize
    window.addEventListener("resize", function() {
        let screenWidth = window.innerWidth;

        if (screenWidth >= 900) {
            if (sidebar.style.display === "flex") {
                logoFull.style.display = "block";
                logoSmall.style.display = "none";
                mainContent.style.marginLeft = "295px"; 
            } else {
                logoSmall.style.display = "block";
                mainContent.style.marginLeft = "25px"; 
            }
        } else if (screenWidth > 700 && screenWidth < 900) {
            if (sidebar.style.display === "flex") {
                logoFull.style.display = "none";
                logoSmall.style.display = "block";
                mainContent.style.marginLeft = "150px"; 
            } else {
                sidebar.style.display = "flex"
                logoSmall.style.display = "block";
                mainContent.style.marginLeft = "25px"; 
            }
        } else if (screenWidth <= 700) {
            sidebar.style.display = "none";
            if (sidebar.style.display == "flex") {
                logoFull.style.display = "none";
                logoSmall.style.display = "block";
                mainContent.style.marginLeft = "150px"; 
            } else {
                sidebar.style.display = "none";
                logoSmall.style.display = "none";
                mainContent.style.marginLeft = "25px"; 
            }
        }
    });
});



// ------------------------ ADD EMPLOYEE PASSWORD MODAL ------------------------
document.addEventListener("DOMContentLoaded", function() {
    const addModal = document.getElementById('addEmployeePasswordModal');
    const addPasswordInput = document.getElementById('add_employee_password');
    const addError = document.getElementById('addEmployeeError');
    const addForm = document.getElementById('addEmployeePasswordForm');
    const cancelAdd = document.getElementById('cancelAddEmployee');

    window.openAddEmployeeModal = function() {
        addModal.style.display = 'block';
        addPasswordInput.value = '';
        addError.style.display = 'none';
    };

    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const password = addPasswordInput.value;

            fetch('../DATABASE/verify_admin_password.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=add_employee&admin_password=' + encodeURIComponent(password)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    addModal.style.display = 'none';
                    window.location.href = 'employees-add.php';
                } else {
                    addError.textContent = data.message || 'Incorrect password.';
                    addError.style.display = 'block';
                    addPasswordInput.value = '';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    }

    if (cancelAdd) {
        cancelAdd.addEventListener('click', function() {
            addModal.style.display = 'none';
        });
    }

});


// ------------------------ EDIT EMPLOYEE WITH PASSWORD CONFIRMATION ------------------------
document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".edit-employee-btn");
    const editModal = document.getElementById("editPasswordModal");
    const editEmployeeId = document.getElementById("edit_employee_id");
    const empNameForEdit = document.getElementById("empNameForEdit");
    const editPasswordInput = document.getElementById("edit_admin_password");
    const editPasswordError = document.getElementById("editPasswordError");
    const editPasswordForm = document.getElementById("editPasswordForm");
    const cancelEditPassword = document.getElementById("cancelEditPassword");

    editButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const empId = this.getAttribute("data-id");
            const empName = this.getAttribute("data-name");
            editEmployeeId.value = empId;
            empNameForEdit.textContent = empName;
            editPasswordInput.value = "";
            editPasswordError.style.display = "none";
            editModal.style.display = "block";
        });
    });

    cancelEditPassword.addEventListener("click", function() {
        editModal.style.display = "none";
    });

    editPasswordForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData();
        formData.append("employee_id", editEmployeeId.value);
        formData.append("admin_password", editPasswordInput.value);

        fetch("../DATABASE/verify_admin_password.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to edit page
                window.location.href = "employees-edit.php?id=" + editEmployeeId.value;
            } else {
                editPasswordError.textContent = data.message || "Incorrect password.";
                editPasswordError.style.display = "block";
                editPasswordInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    // Optional: close modal when clicking outside
    window.addEventListener("click", function(e) {
        if (e.target.classList.contains("content-modal")) {
            e.target.style.display = "none";
        }
    });
});


// ------------------------ DELETE EMPLOYEE MODAL WITH PASSWORD CONFIRMATION ------------------------
document.addEventListener("DOMContentLoaded", function () {
    const empDeleteButtons = document.querySelectorAll(".delete-employee-btn");
    const empModal = document.getElementById("delEmpModal");
    const successModal = document.getElementById("successModal");
    const empNameToDelete = document.getElementById("empNameToDelete");
    const deleteEmployeeId = document.getElementById("delete_employee_id");
    const adminPassword = document.getElementById("admin_password");
    const passwordError = document.getElementById("passwordError");
    const cancelDelete = document.getElementById("cancelDelete");
    const deleteForm = document.getElementById("deleteForm");
    const closeSuccessModal = document.getElementById("closeSuccessModal");

    // Open modal with employee details
    empDeleteButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            let employeeId = this.getAttribute("data-id");
            let employeeName = this.getAttribute("data-name");
            deleteEmployeeId.value = employeeId;
            empNameToDelete.textContent = employeeName;
            adminPassword.value = ""; // clear previous password
            passwordError.style.display = "none";
            empModal.style.display = "block";
        });
    });

    // Cancel delete modal
    cancelDelete.addEventListener("click", function () {
        empModal.style.display = "none";
    });

    // Handle form submission (password + delete)
    deleteForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData();
        formData.append("employee_id", deleteEmployeeId.value);
        formData.append("admin_password", adminPassword.value);

        fetch("../DATABASE/db_deleteEmployee.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                empModal.style.display = "none";
                successModal.style.display = "block";
            } else {
                passwordError.textContent = data.message || "Invalid password or error.";
                passwordError.style.display = "block";
                adminPassword.value = ""; // clear for retry
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    // Close success modal and reload
    closeSuccessModal.addEventListener("click", function () {
        successModal.style.display = "none";
        location.reload();
    });

    // Optional: close modals when clicking outside
    window.addEventListener("click", function (e) {
        if (e.target.classList.contains("content-modal")) {
            e.target.style.display = "none";
        }
    });
});


// ------------------------ RESTORE EMPLOYEE WITH PASSWORD CONFIRMATION ------------------------
document.addEventListener("DOMContentLoaded", function () {
    const restoreButtons = document.querySelectorAll(".restore-employee-btn");
    const restoreModal = document.getElementById("restorePasswordModal");
    const restoreSuccessModal = document.getElementById("restoreSuccessModal");
    const restoreArchiveId = document.getElementById("restore_archive_id");
    const empNameForRestore = document.getElementById("empNameForRestore");
    const restorePasswordInput = document.getElementById("restore_admin_password");
    const restorePasswordError = document.getElementById("restorePasswordError");
    const restoreForm = document.getElementById("restorePasswordForm");
    const cancelRestore = document.getElementById("cancelRestorePassword");
    const closeRestoreSuccess = document.getElementById("closeRestoreSuccessModal");

    restoreButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const archiveId = this.getAttribute("data-archive-id");
            const empName = this.getAttribute("data-name");
            restoreArchiveId.value = archiveId;
            empNameForRestore.textContent = empName;
            restorePasswordInput.value = "";
            restorePasswordError.style.display = "none";
            restoreModal.style.display = "block";
        });
    });

    cancelRestore.addEventListener("click", function() {
        restoreModal.style.display = "none";
    });

    restoreForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData();
        formData.append("archive_id", restoreArchiveId.value);
        formData.append("admin_password", restorePasswordInput.value);

        fetch("../DATABASE/db_restoreArchivedEmp.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                restoreModal.style.display = "none";
                restoreSuccessModal.style.display = "block";
            } else {
                restorePasswordError.textContent = data.message || "Incorrect password or error.";
                restorePasswordError.style.display = "block";
                restorePasswordInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    closeRestoreSuccess.addEventListener("click", function() {
        restoreSuccessModal.style.display = "none";
        location.reload();
    });

    // Optional: close modals when clicking outside
    window.addEventListener("click", function(e) {
        if (e.target.classList.contains("content-modal")) {
            e.target.style.display = "none";
        }
    });
});


// ------------------------ JOB DELETE WITH PASSWORD ------------------------
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-job-btn");
    const deleteModal = document.getElementById("delJobPasswordModal");
    const deleteJobId = document.getElementById("delete_job_id");
    const jobNameForDelete = document.getElementById("jobNameForDelete");
    const deletePasswordInput = document.getElementById("delete_job_password");
    const deletePasswordError = document.getElementById("deleteJobPasswordError");
    const deleteForm = document.getElementById("deleteJobPasswordForm");
    const cancelDelete = document.getElementById("cancelDeleteJobPassword");
    const successModal = document.getElementById("successJobModal");
    const closeSuccess = document.getElementById("closeJobSuccessModal");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const jobId = this.getAttribute("data-id");
            const jobName = this.getAttribute("data-name");
            deleteJobId.value = jobId;
            jobNameForDelete.textContent = jobName;
            deletePasswordInput.value = "";
            deletePasswordError.style.display = "none";
            deleteModal.style.display = "block";
        });
    });

    cancelDelete.addEventListener("click", function() {
        deleteModal.style.display = "none";
    });

    deleteForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData();
        formData.append("job_id", deleteJobId.value);
        formData.append("admin_password", deletePasswordInput.value);

        fetch("../DATABASE/db_deleteJob.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                deleteModal.style.display = "none";
                successModal.style.display = "block";
            } else {
                deletePasswordError.textContent = data.message || "Incorrect password or error.";
                deletePasswordError.style.display = "block";
                deletePasswordInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    closeSuccess.addEventListener("click", function() {
        successModal.style.display = "none";
        location.reload();
    });

    // ------------------------ JOB EDIT WITH PASSWORD ------------------------
    const editButtons = document.querySelectorAll(".edit-job-btn");
    const editModal = document.getElementById("editJobPasswordModal");
    const editJobId = document.getElementById("edit_job_id");
    const jobNameForEdit = document.getElementById("jobNameForEdit");
    const editPasswordInput = document.getElementById("edit_job_password");
    const editPasswordError = document.getElementById("editJobPasswordError");
    const editForm = document.getElementById("editJobPasswordForm");
    const cancelEdit = document.getElementById("cancelEditJobPassword");

    editButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const jobId = this.getAttribute("data-id");
            const jobName = this.getAttribute("data-name");
            editJobId.value = jobId;
            jobNameForEdit.textContent = jobName;
            editPasswordInput.value = "";
            editPasswordError.style.display = "none";
            editModal.style.display = "block";
        });
    });

    cancelEdit.addEventListener("click", function() {
        editModal.style.display = "none";
    });

    editForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData();
        formData.append("job_id", editJobId.value);
        formData.append("admin_password", editPasswordInput.value);

        fetch("../DATABASE/verify_admin_password.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "recruitment-editJob.php?job_id=" + editJobId.value;
            } else {
                editPasswordError.textContent = data.message || "Incorrect password.";
                editPasswordError.style.display = "block";
                editPasswordInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    // Close modals when clicking outside
    window.addEventListener("click", function(e) {
        if (e.target.classList.contains("content-modal")) {
            e.target.style.display = "none";
        }
    });
});


// ------------------------ EDIT DEPARTMENT WITH PASSWORD ------------------------
document.addEventListener("DOMContentLoaded", function() {
    const editButtons = document.querySelectorAll(".edit-department-btn"); // note class on edit link
    const editModal = document.getElementById("editDeptPasswordModal");
    const editDeptId = document.getElementById("edit_dept_id");
    const deptNameForEdit = document.getElementById("deptNameForEdit");
    const editPasswordInput = document.getElementById("edit_dept_password");
    const editPasswordError = document.getElementById("editDeptPasswordError");
    const editForm = document.getElementById("editDeptPasswordForm");
    const cancelEdit = document.getElementById("cancelEditDeptPassword");

    editButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const deptId = this.getAttribute("data-id");
            const deptName = this.getAttribute("data-name");
            editDeptId.value = deptId;
            deptNameForEdit.textContent = deptName;
            editPasswordInput.value = "";
            editPasswordError.style.display = "none";
            editModal.style.display = "block";
        });
    });

    cancelEdit.addEventListener("click", function() {
        editModal.style.display = "none";
    });

    editForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("department_id", editDeptId.value);
        formData.append("admin_password", editPasswordInput.value);

        fetch("../DATABASE/verify_admin_password.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "departments-edit.php?id=" + editDeptId.value;
            } else {
                editPasswordError.textContent = data.message || "Incorrect password.";
                editPasswordError.style.display = "block";
                editPasswordInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    // ------------------------ DELETE DEPARTMENT ------------------------
    const deleteButtons = document.querySelectorAll(".delete-department-btn");
    const deleteModal = document.getElementById("delDeptPasswordModal");
    const deleteDeptId = document.getElementById("delete_dept_id");
    const deptNameForDelete = document.getElementById("deptNameForDelete");
    const deletePasswordInput = document.getElementById("delete_dept_password");
    const deletePasswordError = document.getElementById("deleteDeptPasswordError");
    const deleteForm = document.getElementById("deleteDeptPasswordForm");
    const cancelDelete = document.getElementById("cancelDeleteDeptPassword");
    const successModal = document.getElementById("successDeptModal");
    const closeSuccess = document.getElementById("closeDeptSuccessModal");

    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const deptId = this.getAttribute("data-id");
            const deptName = this.getAttribute("data-name");
            deleteDeptId.value = deptId;
            deptNameForDelete.textContent = deptName;
            deletePasswordInput.value = "";
            deletePasswordError.style.display = "none";
            deleteModal.style.display = "block";
        });
    });

    cancelDelete.addEventListener("click", function() {
        deleteModal.style.display = "none";
    });

    deleteForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("department_id", deleteDeptId.value);
        formData.append("admin_password", deletePasswordInput.value);

        fetch("../DATABASE/db_deleteDepartment.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                deleteModal.style.display = "none";
                successModal.style.display = "block";
            } else {
                deletePasswordError.textContent = data.message || "Incorrect password or error.";
                deletePasswordError.style.display = "block";
                deletePasswordInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    closeSuccess.addEventListener("click", function() {
        successModal.style.display = "none";
        location.reload();
    });

    // Close modals when clicking outside
    window.addEventListener("click", function(e) {
        if (e.target.classList.contains("content-modal")) {
            e.target.style.display = "none";
        }
    });
});


// ------------------------ EDIT POSITION WITH PASSWORD ------------------------
document.addEventListener("DOMContentLoaded", function() {
    const editButtons = document.querySelectorAll(".edit-position-btn");
    const editModal = document.getElementById("editPosPasswordModal");
    const editPosId = document.getElementById("edit_pos_id");
    const posNameForEdit = document.getElementById("posNameForEdit");
    const editPasswordInput = document.getElementById("edit_pos_password");
    const editPasswordError = document.getElementById("editPosPasswordError");
    const editForm = document.getElementById("editPosPasswordForm");
    const cancelEdit = document.getElementById("cancelEditPosPassword");

    editButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const posId = this.getAttribute("data-id");
            const posName = this.getAttribute("data-name");
            editPosId.value = posId;
            posNameForEdit.textContent = posName;
            editPasswordInput.value = "";
            editPasswordError.style.display = "none";
            editModal.style.display = "block";
        });
    });

    cancelEdit.addEventListener("click", function() {
        editModal.style.display = "none";
    });

    editForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("position_id", editPosId.value);
        formData.append("admin_password", editPasswordInput.value);

        fetch("../DATABASE/verify_admin_password.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "positions-edit.php?position_id=" + editPosId.value;
            } else {
                editPasswordError.textContent = data.message || "Incorrect password.";
                editPasswordError.style.display = "block";
                editPasswordInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    // ------------------------ DELETE POSITION ------------------------
    const deleteButtons = document.querySelectorAll(".delete-position-btn");
    const deleteModal = document.getElementById("delPosPasswordModal");
    const deletePosId = document.getElementById("delete_pos_id");
    const posNameForDelete = document.getElementById("posNameForDelete");
    const deletePasswordInput = document.getElementById("delete_pos_password");
    const deletePasswordError = document.getElementById("deletePosPasswordError");
    const deleteForm = document.getElementById("deletePosPasswordForm");
    const cancelDelete = document.getElementById("cancelDeletePosPassword");
    const successModal = document.getElementById("successPosModal");
    const closeSuccess = document.getElementById("closePosSuccessModal");

    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const posId = this.getAttribute("data-id");
            const posName = this.getAttribute("data-name");
            deletePosId.value = posId;
            posNameForDelete.textContent = posName;
            deletePasswordInput.value = "";
            deletePasswordError.style.display = "none";
            deleteModal.style.display = "block";
        });
    });

    cancelDelete.addEventListener("click", function() {
        deleteModal.style.display = "none";
    });

    deleteForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("position_id", deletePosId.value);
        formData.append("admin_password", deletePasswordInput.value);

        fetch("../DATABASE/db_deletePosition.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                deleteModal.style.display = "none";
                successModal.style.display = "block";
            } else {
                deletePasswordError.textContent = data.message || "Incorrect password or error.";
                deletePasswordError.style.display = "block";
                deletePasswordInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    closeSuccess.addEventListener("click", function() {
        successModal.style.display = "none";
        location.reload();
    });

    // Close modals when clicking outside
    window.addEventListener("click", function(e) {
        if (e.target.classList.contains("content-modal")) {
            e.target.style.display = "none";
        }
    });
});



// ------------------------ EDIT REQUEST RESPONSE WITH PASSWORD ------------------------
document.addEventListener("DOMContentLoaded", function() {
    const editButtons = document.querySelectorAll(".edit-request-btn");
    const editModal = document.getElementById("editRequestPasswordModal");
    const editLeaveId = document.getElementById("edit_leave_id");
    const requestNameForEdit = document.getElementById("requestNameForEdit");
    const editPasswordInput = document.getElementById("edit_request_password");
    const editPasswordError = document.getElementById("editRequestPasswordError");
    const editForm = document.getElementById("editRequestPasswordForm");
    const cancelEdit = document.getElementById("cancelEditRequestPassword");

    editButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const leaveId = this.getAttribute("data-id");
            const name = this.getAttribute("data-name");
            editLeaveId.value = leaveId;
            requestNameForEdit.textContent = name;
            editPasswordInput.value = "";
            editPasswordError.style.display = "none";
            editModal.style.display = "block";
        });
    });

    cancelEdit.addEventListener("click", function() {
        editModal.style.display = "none";
    });

    editForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("leave_id", editLeaveId.value);
        formData.append("admin_password", editPasswordInput.value);

        fetch("../DATABASE/verify_admin_password.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "request-edit.php?leave_id=" + editLeaveId.value;
            } else {
                editPasswordError.textContent = data.message || "Incorrect password.";
                editPasswordError.style.display = "block";
                editPasswordInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    // Close modal when clicking outside
    window.addEventListener("click", function(e) {
        if (e.target.classList.contains("content-modal")) {
            e.target.style.display = "none";
        }
    });
});


// ------------------------ EDIT PAYROLL WITH PASSWORD ------------------------
document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".edit-payroll-btn");
    const editModal = document.getElementById("editPayrollPasswordModal");
    const editPayrollId = document.getElementById("edit_payroll_id");
    const payrollNameForEdit = document.getElementById("payrollNameForEdit");
    const editPasswordInput = document.getElementById("edit_payroll_password");
    const editPasswordError = document.getElementById("editPayrollPasswordError");
    const editForm = document.getElementById("editPayrollPasswordForm");
    const cancelEdit = document.getElementById("cancelEditPayrollPassword");

    editButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const payrollId = this.getAttribute("data-id");
            const employeeName = this.getAttribute("data-name");
            editPayrollId.value = payrollId;
            payrollNameForEdit.textContent = employeeName;
            editPasswordInput.value = "";
            editPasswordError.style.display = "none";
            editModal.style.display = "block";
        });
    });

    cancelEdit.addEventListener("click", function() {
        editModal.style.display = "none";
    });

    editForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData();
        formData.append("payroll_id", editPayrollId.value);
        formData.append("admin_password", editPasswordInput.value);

        fetch("../DATABASE/verify_admin_password.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "payroll-edit.php?id=" + editPayrollId.value;
            } else {
                editPasswordError.textContent = data.message || "Incorrect password.";
                editPasswordError.style.display = "block";
                editPasswordInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    });
});


// ------------------------ GENERATE PAYROLL PASSWORD MODAL ------------------------
document.addEventListener("DOMContentLoaded", function() {
    const generateModal = document.getElementById('generatePayrollPasswordModal');
    const generateForm = document.getElementById('generatePayrollPasswordForm');
    const generatePassword = document.getElementById('generate_admin_password');
    const generateError = document.getElementById('generatePasswordError');
    const cancelGenerate = document.getElementById('cancelGeneratePassword');

    window.openGeneratePasswordModal = function() {
        generateModal.style.display = 'block';
        generatePassword.value = '';
        generateError.style.display = 'none';
    };

    if (generateForm) {
        generateForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const password = generatePassword.value;
            document.getElementById('generate_password').value = password;
            document.getElementById('generatePayrollForm').submit();
        });
    }

    if (cancelGenerate) {
        cancelGenerate.addEventListener('click', function() {
            generateModal.style.display = 'none';
        });
    }

    // ------------------------ INCREASE PAYROLL PASSWORD MODAL ------------------------
    const increaseModal = document.getElementById('increasePayrollPasswordModal');
    const increaseForm = document.getElementById('increasePayrollPasswordForm');
    const increasePassword = document.getElementById('increase_admin_password');
    const increaseError = document.getElementById('increasePasswordError');
    const cancelIncrease = document.getElementById('cancelIncreasePassword');

    window.openIncreasePasswordModal = function() {
        increaseModal.style.display = 'block';
        increasePassword.value = '';
        increaseError.style.display = 'none';
    };

    if (increaseForm) {
        increaseForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const password = increasePassword.value;

            fetch('../DATABASE/verify_admin_password.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=increase&admin_password=' + encodeURIComponent(password)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'payroll-increase.php';
                } else {
                    increaseError.textContent = data.message || 'Incorrect password.';
                    increaseError.style.display = 'block';
                    increasePassword.value = '';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    }

    if (cancelIncrease) {
        cancelIncrease.addEventListener('click', function() {
            increaseModal.style.display = 'none';
        });
    }

    // Close modals when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target.classList.contains('content-modal')) {
            e.target.style.display = 'none';
        }
    });
});



// PROFILE MODAL AND INPUT VALIDATION AND SANITATION----------------------------------



// ------------------------ AUTO GENERATE EMAIL AND PASSWORD FUNCTION ------------------------
function generateEmail() {
    let firstName = document.getElementById("first_name").value.trim().toLowerCase();
    let lastName = document.getElementById("last_name").value.trim().toLowerCase();
    if (firstName && lastName) {
        let randomNum = Math.floor(100 + Math.random() * 900);
        let email = firstName.charAt(0) + "." + lastName + "." + randomNum + "@company.com";
        document.getElementById("email").value = email;
        document.getElementById("password").value = lastName + randomNum;
    }
}

// ------------------------AUTOMATIC AGE CALCULATION AFTER SETTING DOB FUNCTION ------------------------
document.addEventListener("DOMContentLoaded", function () {
    const dobInput = document.querySelector('input[name="dob"]');
    const ageInput = document.querySelector('input[name="age"]');

    dobInput.addEventListener("change", function () {
        if (dobInput.value) {
            const dob = new Date(dobInput.value);
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();

            // Adjust if birthday hasn't occurred yet this year
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            ageInput.value = age; // Set calculated age
        } else {
            ageInput.value = ""; // Clear age if no DOB is selected
        }
    });
});


// ------------------------ CLOCKIN / CLOCKOUT WIDGET ------------------------
document.addEventListener("DOMContentLoaded", async function () {
    const clockText = document.getElementById("clockText");
    const clockLink = document.getElementById("clockLink");
    const currentDateElement = document.getElementById("currentDate");

    // Set the current date
    const today = new Date();
    const options = { weekday: "long", day: "2-digit", month: "2-digit", year: "numeric" };
    currentDateElement.textContent = today.toLocaleDateString("en-GB", options);

    try {
        // Fetch attendance status
        const response = await fetch("../DATABASE/db_checkAttendance.php");
        const data = await response.json();

        if (data.error) {
            console.error("Error:", data.error);
            return;
        }

        // Ensure correct UI state
        if (data.clock_status === "clock_in") {
            clockText.textContent = "Clock In";
            clockLink.dataset.action = "clock_in";
            clockLink.href = "#"; 
            clockLink.style.pointerEvents = "auto";
            clockLink.style.opacity = "1";
        } else if (data.clock_status === "clock_out") {
            clockText.textContent = "Clock Out";
            clockLink.dataset.action = "clock_out";
        } else if (data.clock_status === "completed") {
            clockText.textContent = "Already Clocked Out";
            clockLink.removeAttribute("href");
            clockLink.style.pointerEvents = "none";
            clockLink.style.opacity = "0.5";
        }
    } catch (error) {
        console.error("Error fetching attendance status:", error);
    }

    // Handle Clock In/Out Click
    clockLink.addEventListener("click", async function (event) {
        event.preventDefault();

        const action = clockLink.dataset.action;
        if (!action) return;

        try {
            const response = await fetch("../DATABASE/db_clock.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ action }),
            });
            const data = await response.json();

            if (data.status === "clocked_in") {
                clockText.textContent = "Clock Out";
                clockLink.dataset.action = "clock_out";
            } else if (data.status === "clocked_out") {
                clockText.textContent = "Already Clocked Out";
                clockLink.removeAttribute("href");
                clockLink.style.pointerEvents = "none";
                clockLink.style.opacity = "0.5";
            }
        } catch (error) {
            console.error("Error clocking in/out:", error);
        }
    });
});

// ------------------------ QUOTES PER DAY ------------------------
document.addEventListener("DOMContentLoaded", function() {
    const quotes = [
        { text: "The only way to do great work is to love what you do.", author: "Steve Jobs" },
        { text: "Success is not the key to happiness. Happiness is the key to success.", author: "Albert Schweitzer" },
        { text: "Believe you can and you're halfway there.", author: "Theodore Roosevelt" },
        { text: "Keep your face always toward the sunshine—and shadows will fall behind you.", author: "Walt Whitman" },
        { text: "Act as if what you do makes a difference. It does.", author: "William James" },
        { text: "Do what you can, with what you have, where you are.", author: "Theodore Roosevelt" },
        { text: "Your work is going to fill a large part of your life, and the only way to be truly satisfied is to do what you believe is great work.", author: "Steve Jobs" },
        { text: "Success is not final, failure is not fatal: it is the courage to continue that counts.", author: "Winston Churchill" },
        { text: "The future depends on what you do today.", author: "Mahatma Gandhi" },
        { text: "It always seems impossible until it’s done.", author: "Nelson Mandela" },
        { text: "Don’t watch the clock; do what it does. Keep going.", author: "Sam Levenson" },
        { text: "Hardships often prepare ordinary people for an extraordinary destiny.", author: "C.S. Lewis" },
        { text: "Start where you are. Use what you have. Do what you can.", author: "Arthur Ashe" },
        { text: "Happiness is not something ready-made. It comes from your own actions.", author: "Dalai Lama" },
        { text: "The only limit to our realization of tomorrow is our doubts of today.", author: "Franklin D. Roosevelt" }
    ];

    const today = new Date();
    const dateSeed = today.getFullYear() * 10000 + (today.getMonth() + 1) * 100 + today.getDate();
    const quoteIndex = dateSeed % quotes.length;

    document.getElementById("quoteText").textContent = `"${quotes[quoteIndex].text}"`;
    document.getElementById("quoteAuthor").textContent = `- ${quotes[quoteIndex].author}`;
});

// ------------------------ NEW POSITION - RECRUITMENT ------------------------
document.getElementById("job_title").addEventListener("change", function() {
    let newPositionInput = document.getElementById("new_position");
    let salaryDropdown = document.getElementById("salary");

    if (this.value === "new") {
        newPositionInput.style.display = "block";
        newPositionInput.required = true;
        salaryDropdown.value = ""; 
    } else {
        newPositionInput.style.display = "none";
        newPositionInput.required = false;
    }
});

// ------------------------ BASE SALARY - RECRUITMENT ------------------------
document.getElementById("job_title").addEventListener("change", function() {
    let positionId = this.value;
    let salaryField = document.getElementById("salary");
    let newPositionInput = document.getElementById("new_position");

    if (positionId === "new") {
        newPositionInput.style.display = "block";
        newPositionInput.required = true;
        salaryField.value = ""; // Allow custom salary
        salaryField.readOnly = false;
    } else {
        newPositionInput.style.display = "none";
        newPositionInput.required = false;

        // Fetch salary from the database
        fetch('DATABASE/db_get_salary.php?position_id=' + positionId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    salaryField.value = data.base_salary;
                    salaryField.readOnly = true; // Make it readonly if preloaded
                } else {
                    salaryField.value = "";
                    salaryField.readOnly = false; // Allow custom salary if no match
                }
            })
            .catch(error => console.error("Error fetching salary:", error));
    }
});

// ------------------------ NEW DEPARTMENT - RECRUITMENT ------------------------
document.getElementById("department").addEventListener("change", function() {
    let newDepartmentInput = document.getElementById("new_department");

    if (this.value === "new") {
        newDepartmentInput.style.display = "block";
        newDepartmentInput.required = true;
    } else {
        newDepartmentInput.style.display = "none";
        newDepartmentInput.required = false;
    }
});

// ------------------------ CONTACT NUMBER RESTRICTION ------------------------
document.addEventListener("DOMContentLoaded", function() {
    let phoneInput = document.getElementById("phone");

    phoneInput.addEventListener("input", function() {
        // Ensure the input always starts with "09"
        if (!this.value.startsWith("09")) {
            this.value = "09";
        }

        // Remove non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, "");

        // Limit input to 11 characters
        if (this.value.length > 11) {
            this.value = this.value.slice(0, 11);
        }

        // Hide error while typing
        this.setCustomValidity("");
    });

    phoneInput.addEventListener("blur", function() {
        // Show validation error only when the user leaves the field
        if (this.value.length < 11) {
            this.setCustomValidity("Phone number must be 11 digits (e.g., 09123456789).");
            this.reportValidity(); // Show tooltip
        } else {
            this.setCustomValidity("");
        }
    });

    phoneInput.addEventListener("keydown", function(e) {
        // Prevent deletion of "09"
        if ((this.selectionStart < 2 || this.selectionEnd < 2) && (e.key === "Backspace" || e.key === "Delete")) {
            e.preventDefault();
        }
    });
});

