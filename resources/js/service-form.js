document.addEventListener('DOMContentLoaded', initializeServiceForm);

document.addEventListener('alpine:init', () => {
    Alpine.effect(() => {
        setTimeout(initializeServiceForm, 50);
    });
});

function initializeServiceForm() {
    initializePhotoInput();
    initializeCanvas();
}


function initializePhotoInput() {
    const photoInput = document.querySelector('input[name="dokumentasi[]"]');
    if (!photoInput || photoInput.dataset.ready) return;

    photoInput.dataset.ready = 'true';

    photoInput.addEventListener('change', function () {
        validateFileCount(this);
        previewImages(this);
    });
}

function validateFileCount(input) {
    if (input.files.length > 10) {
        alert('Maksimal 10 foto diperbolehkan');
        input.value = '';
        previewImages(input);
    }
}

function previewImages(input) {
    const previewContainer = document.getElementById('photoPreview');
    if (!previewContainer) return;

    previewContainer.innerHTML = '';

    const files = Array.from(input.files);
    if (!files.length) {
        previewContainer.classList.add('hidden');
        return;
    }

    previewContainer.classList.remove('hidden');

    files.forEach((file, index) => {
        if (!file.type.startsWith('image/')) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'relative';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-full h-32 object-cover rounded border';

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.textContent = '×';
            removeBtn.className =
                'absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center';

            removeBtn.addEventListener('click', () => {
                removeImageByIndex(input, index);
            });

            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            previewContainer.appendChild(wrapper);
        };

        reader.readAsDataURL(file);
    });
}

function removeImageByIndex(input, removeIndex) {
    const dt = new DataTransfer();

    Array.from(input.files).forEach((file, index) => {
        if (index !== removeIndex) {
            dt.items.add(file);
        }
    });

    input.files = dt.files;
    previewImages(input);
}


function initializeCanvas() {
    const canvas = document.getElementById('signatureCanvas');
    if (!canvas || canvas.dataset.ready) return;

    canvas.dataset.ready = 'true';

    const ctx = canvas.getContext('2d');
    canvas.drawing = false;

    // Background putih
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Mouse events
    canvas.addEventListener('mousedown', (e) => startDrawing(e, ctx, canvas));
    canvas.addEventListener('mousemove', (e) => draw(e, ctx, canvas));
    canvas.addEventListener('mouseup', () => stopDrawing(canvas));
    canvas.addEventListener('mouseout', () => stopDrawing(canvas));

    // Touch events
    canvas.addEventListener('touchstart', (e) => handleTouchStart(e, ctx, canvas), { passive: false });
    canvas.addEventListener('touchmove', (e) => handleTouchMove(e, ctx, canvas), { passive: false });
    canvas.addEventListener('touchend', () => stopDrawing(canvas));
}

function startDrawing(e, ctx, canvas) {
    canvas.drawing = true;
    const rect = canvas.getBoundingClientRect();
    ctx.beginPath();
    ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
}

function draw(e, ctx, canvas) {
    if (!canvas.drawing) return;

    const rect = canvas.getBoundingClientRect();
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.strokeStyle = 'black';

    ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
    ctx.stroke();
}

function stopDrawing(canvas) {
    canvas.drawing = false;
    updateSignatureInput();
}

function handleTouchStart(e, ctx, canvas) {
    e.preventDefault();
    const t = e.touches[0];
    startDrawing(
        { clientX: t.clientX, clientY: t.clientY },
        ctx,
        canvas
    );
}

function handleTouchMove(e, ctx, canvas) {
    e.preventDefault();
    const t = e.touches[0];
    draw(
        { clientX: t.clientX, clientY: t.clientY },
        ctx,
        canvas
    );
}

function updateSignatureInput() {
    const canvas = document.getElementById('signatureCanvas');
    const input = document.getElementById('signatureInput');
    if (!canvas || !input) return;

    input.value = canvas.toDataURL('image/png');
}

function clearSignature() {
    const canvas = document.getElementById('signatureCanvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    document.getElementById('signatureInput').value = '';
}

window.clearSignature = clearSignature;
