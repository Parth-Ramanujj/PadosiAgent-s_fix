// Countdown Timer
function calculateTimeLeft() {
    const targetDate = new Date('2025-12-01T00:00:00').getTime();
    const now = new Date().getTime();
    const difference = targetDate - now;

    if (difference > 0) {
        return {
            days: Math.floor(difference / (1000 * 60 * 60 * 24)),
            hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
            minutes: Math.floor((difference / 1000 / 60) % 60),
            seconds: Math.floor((difference / 1000) % 60)
        };
    }

    return { days: 0, hours: 0, minutes: 0, seconds: 0 };
}

function formatNumber(num) {
    return num.toString().padStart(2, '0');
}

function updateCountdown() {
    const timeLeft = calculateTimeLeft();

    document.getElementById('days').textContent = formatNumber(timeLeft.days);
    document.getElementById('hours').textContent = formatNumber(timeLeft.hours);
    document.getElementById('minutes').textContent = formatNumber(timeLeft.minutes);
    document.getElementById('seconds').textContent = formatNumber(timeLeft.seconds);
}

// Initialize countdown
updateCountdown();

// Update countdown every second
setInterval(updateCountdown, 1000);

// Button click handlers (you can customize these)
document.addEventListener('DOMContentLoaded', function () {
    const primaryBtn = document.querySelector('.btn-primary');
    const secondaryBtn = document.querySelector('.btn-secondary');

    // if (primaryBtn) {
    //     primaryBtn.addEventListener('click', function () {
    //         alert('Thank you for your interest in becoming an Agent! Registration will open on December 1st, 2025.');
    //     });
    // }

    // if (secondaryBtn) {
    //     secondaryBtn.addEventListener('click', function () {
    //         alert('Thank you for your interest in becoming a Customer! Registration will open on December 1st, 2025.');
    //     });
    // }
});

// Smooth scroll animation on load
window.addEventListener('load', function () {
    document.body.style.opacity = '0';
    setTimeout(function () {
        document.body.style.transition = 'opacity 0.5s ease-in';
        document.body.style.opacity = '1';
    }, 100);
});


// document.getElementById('participantForm').addEventListener('submit', async function (e) {
//     e.preventDefault();

//     const formData = new FormData(this);
//     const submitBtn = this.querySelector('button[type="submit"]');
//     submitBtn.disabled = true;
//     submitBtn.textContent = 'Processing...';

//     try {
//         const response = await fetch('{{ url("/participants") }}', {
//             method: 'POST',
//             body: formData,
//             headers: {
//                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
//                 'X-Requested-With': 'XMLHttpRequest',
//                 'Accept': 'application/json'
//             }
//         });

//         const data = await response.json();

//         if (!response.ok) {
//             // Handle 422 validation errors
//             if (response.status === 422 && data.errors) {
//                 // Display validation errors
//                 displayErrors(data.errors);
//                 showAlert('Please fix the validation errors below.', 'error');
//             } else if (data.message) {
//                 showAlert(data.message, 'error');
//             } else {
//                 throw new Error(`HTTP error! status: ${response.status}`);
//             }
//         } else if (data.success) {
//             // Show success popup with sharing options
//             showSuccessPopup(data.share_url, data.participant);
//             showAlert('Registration completed successfully!', 'success');

//             // Reset form
//             this.reset();
//         } else {
//             showAlert(data.message || 'Error saving information.', 'error');
//         }
//     } catch (error) {
//         // Only show network errors, not 422 errors (they're handled above)
//         if (!error.message.includes('HTTP error! status: 422')) {
//             showAlert('Network Error: ' + error.message, 'error');
//         }
//     } finally {
//         submitBtn.disabled = false;
//         submitBtn.textContent = 'Submit';
//     }
// });

// // Use your existing displayErrors function
// function displayErrors(errors) {
//     // Clear previous errors
//     clearErrors();

//     for (const [field, messages] of Object.entries(errors)) {
//         const errorElement = document.getElementById(`${field}_error`);
//         if (errorElement) {
//             errorElement.textContent = messages[0];
//             errorElement.style.display = 'block';
//         }

//         // Also highlight the input field
//         const inputField = document.querySelector(`[name="${field}"]`);
//         if (inputField) {
//             inputField.classList.add('error-border');
//         }
//     }
// }

// // Use your existing clearErrors function
// function clearErrors() {
//     const errorElements = document.querySelectorAll('.error-message');
//     errorElements.forEach(element => {
//         element.textContent = '';
//         element.style.display = 'none';
//     });

//     const errorInputs = document.querySelectorAll('.error-border');
//     errorInputs.forEach(input => {
//         input.classList.remove('error-border');
//     });
// }

// // Success Popup Functions - keep these as they're specific to participant form
// function showSuccessPopup(shareUrl, participant) {
//     const popup = document.getElementById('successPopup');
//     popup.style.display = 'flex';

//     // Store share URL for later use
//     popup.setAttribute('data-share-url', shareUrl);

//     // Start counter animations
//     animateCounter('shareCount', 0, Math.floor(Math.random() * 50) + 10, 2000);
//     animateCounter('friendCount', 0, Math.floor(Math.random() * 20) + 5, 2500);
// }

// function shareOnFacebook() {
//     const shareUrl = document.getElementById('successPopup').getAttribute('data-share-url');
//     const shareText = "I just registered as a participant! Join me in this amazing experience! 🚀";

//     const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}&quote=${encodeURIComponent(shareText)}`;

//     window.open(facebookShareUrl, 'facebook-share', 'width=600,height=400');

//     // Increment share count
//     incrementCounter('shareCount');
// }

// function copyShareLink() {
//     const shareUrl = document.getElementById('successPopup').getAttribute('data-share-url');

//     navigator.clipboard.writeText(shareUrl).then(() => {
//         // Show copied feedback
//         const copyBtn = document.querySelector('.copy-link-btn');
//         const originalText = copyBtn.innerHTML;
//         copyBtn.innerHTML = '✓ Link Copied!';
//         copyBtn.style.borderColor = '#10B981';
//         copyBtn.style.color = '#10B981';

//         setTimeout(() => {
//             copyBtn.innerHTML = originalText;
//             copyBtn.style.borderColor = '#E5E7EB';
//             copyBtn.style.color = '#374151';
//         }, 2000);
//     }).catch(err => {
//         showAlert('Failed to copy link: ' + err, 'error');
//     });
// }

// function animateCounter(elementId, start, end, duration) {
//     const element = document.getElementById(elementId);
//     let startTimestamp = null;

//     const step = (timestamp) => {
//         if (!startTimestamp) startTimestamp = timestamp;
//         const progress = Math.min((timestamp - startTimestamp) / duration, 1);
//         const value = Math.floor(progress * (end - start) + start);
//         element.textContent = value;

//         if (progress < 1) {
//             window.requestAnimationFrame(step);
//         }
//     };

//     window.requestAnimationFrame(step);
// }

// function incrementCounter(elementId) {
//     const element = document.getElementById(elementId);
//     const current = parseInt(element.textContent);
//     element.textContent = current + 1;
// }

// function closeSuccessPopup() {
//     document.getElementById('successPopup').style.display = 'none';
// }

// function viewDashboard() {
//     window.location.href = '/dashboard';
// }