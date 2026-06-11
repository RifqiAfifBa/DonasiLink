const customAmountInput = document.getElementById("customAmount");

// Function untuk update display
function updateDisplay(amount) {
    if (!amount || amount <= 0) {
        document.getElementById("displayAmount").textContent = "Rp. 0";
        document.getElementById("totalAmount").textContent = "Rp. 0";
        return;
    }

    const formatted = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(amount);

    document.getElementById("displayAmount").textContent = formatted;
    document.getElementById("totalAmount").textContent = formatted;
}

// Event listener untuk tombol preset
document.querySelectorAll(".amount-btn").forEach((btn) => {
    btn.addEventListener("click", function (e) {
        e.preventDefault();
        const amount = this.dataset.amount;

        // Jika custom, fokus ke input
        if (amount === "custom") {
            customAmountInput.focus();
            return;
        }

        // Clear semua active class dan input custom
        document
            .querySelectorAll(".amount-btn")
            .forEach((b) => b.classList.remove("active"));
        customAmountInput.value = "";

        this.classList.add("active");
        const parsedAmount = parseInt(amount);
        updateDisplay(parsedAmount);
    });
});

// Event listener real-time untuk input custom
customAmountInput.addEventListener("input", function () {
    const amount = parseInt(this.value) || 0;

    // Remove active dari tombol preset
    document
        .querySelectorAll(".amount-btn")
        .forEach((b) => b.classList.remove("active"));

    // Mark tombol custom sebagai active jika ada nilai
    if (amount > 0) {
        document
            .querySelector('[data-amount="custom"]')
            .classList.add("active");
    } else {
        document
            .querySelector('[data-amount="custom"]')
            .classList.remove("active");
    }

    updateDisplay(amount);
});

document
    .getElementById("checkoutForm")
    .addEventListener("submit", function (e) {
        e.preventDefault();
        const finalAmount =
            document.getElementById("displayAmount").textContent;
        if (finalAmount === "Rp. 0" || finalAmount === 0) {
            alert("Silakan masukkan jumlah donasi terlebih dahulu!");
            return;
        }
        alert("Terima kasih! Donasi Anda sedang diproses.");
    });
