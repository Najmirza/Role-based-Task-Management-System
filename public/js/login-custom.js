
// 3D Tilt Effect
const cards = document.querySelectorAll('.glass-panel');

cards.forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        // Calculate rotation (max 10deg)
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = ((y - centerY) / centerY) * -4; // Invert axis for tilt
        const rotateY = ((x - centerX) / centerX) * 4;

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    });

    // Reset on leave
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
        card.style.transition = 'transform 0.5s ease';
    });

    // Remove transition on enter to make movement fluid
    card.addEventListener('mouseenter', () => {
        card.style.transition = 'none';
    });
});

// Existing Logic
const slider = document.getElementById('forms-slider');
const switchBg = document.getElementById('switch-bg');
const tabSignin = document.getElementById('tab-signin');
const tabSignup = document.getElementById('tab-signup');

function switchMode(mode) {
    if (mode === 'signin') {
        slider.className = 'forms-slider mode-signin';
        switchBg.style.transform = 'translateX(0)';
        tabSignin.classList.add('active');
        tabSignup.classList.remove('active');
    } else {
        slider.className = 'forms-slider mode-signup';
        switchBg.style.transform = 'translateX(100%)';
        tabSignup.classList.add('active');
        tabSignin.classList.remove('active');
    }
}

function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}

// function showToast(msg, isError = false) {
//     const toast = document.getElementById('toast');
//     toast.textContent = msg;
//     toast.className = isError ? 'toast error-msg visible' : 'toast visible';
//     setTimeout(() => toast.classList.remove('visible'), 3000);
// }

// NOTE: Specific form handling is done via standard form submission in Laravel,
// but these listeners are kept for UI behavior if needed, or we might need to remove preventDefault
// if we want standard submission.
// For now, I'll adapt the Blade file to NOT use these onsubmit handlers for actual submission,
// or modify them to allow submission if basic client-side validation passes.
// However, the provided code uses them to simulate API calls. I will remove the simulation part
// in the blade file integration, so these functions might be redundant or just used for UI feedback if AJAX was used.
// Since we are doing standard POST, I will comment out the simulation parts.


// function handleLogin(e) {
//     e.preventDefault();
//     // Simulate API call
//     setTimeout(() => showToast('Welcome back!'), 400);
// }

// function handleSignup(e) {
//     e.preventDefault();
//     setTimeout(() => {
//         showToast('Account created successfully!');
//         setTimeout(() => switchMode('signin'), 1500);
//     }, 400);
// }

// Simple Smooth Scroll for Anchor Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

function showToast() {
    const toast = document.getElementById('toast');
    toast.style.transform = 'translateX(0)';
    toast.style.opacity = '1';

    setTimeout(() => {
        toast.style.transform = 'translateX(400px)';
        toast.style.opacity = '0';
    }, 3000);
}