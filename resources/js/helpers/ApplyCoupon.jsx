const ApplyCoupon = async (couponCode, setCoupon, setCouponCode, store_id) => {
    if (couponCode == "") {
        setCoupon(null);
        return;
    }
    const token = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;
    const response = await fetch(`https://otogoto.me/applyCoupon`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
        body: JSON.stringify({
            code: couponCode,
            store_id: store_id,
        }),
    });
    const reposnseData = await response.json();

    if (response.ok) {
        if (reposnseData.status) {
            setCoupon(reposnseData.data);
            setCouponCode("");
        } else {
            setCoupon(null);
        }
    }
};

export default ApplyCoupon;
