//This is the original version of signup.js before overhaul

function nextPage(currentId) {
    const currentSection = document.getElementById(currentId);
    const role = document.getElementById('signup-user-acctype').value;
    const roleTracker = document.getElementById('user-role-tracker');
    
    // Update the hidden variable to keep track for the final redirect
    roleTracker.value = role;

    // Hide current section
    currentSection.classList.add('hidden');

    // Logic for branching paths
    if (currentId === 'pg-1') {
        if (role === 'buyer-acc') {
            document.getElementById('signup-pg-2-buyer').classList.remove('hidden');
        } else {
            document.getElementById('signup-pg-2-seller').classList.remove('hidden');
        }
    } 
    // Buyer Flow Navigation
    else if (currentId === 'signup-pg-2-buyer') {
        document.getElementById('signup-pg-3-buyer').classList.remove('hidden');
    } 
    else if (currentId === 'signup-pg-3-buyer') {
        document.getElementById('signup-pg-4-buyer').classList.remove('hidden');
    }
    // Final Transitions to Success Page
    else if (currentId === 'signup-pg-4-buyer' || currentId === 'signup-pg-2-seller') {
        document.getElementById('signup-user-final_page').classList.remove('hidden');
    }
}

function finalRedirect() {
    const role = document.getElementById('user-role-tracker').value;
    
    if (role === 'seller-acc') {
        window.location.href = "seller.html";
    } else {
        window.location.href = "products.html";
    }
}