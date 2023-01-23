import React from "react";
import { useSelector } from "react-redux";

function ResponsiveCart() {
    const { total } = useSelector((state) => state.cart);

    const color_1 = localStorage.getItem('color_1');
    const currency = localStorage.getItem('currency');

    return (
        <>
            {
            total ?
            <div
                className="responsive-cart"
                data-toggle="modal"
                data-target="#modal-cart"
                style={{ backgroundColor: color_1 }}
            >
                <div className="d-flex">
                    <span className="d-flex flex-row-reverse mx-2">
                        <span>{currency}</span>
                        <span className="mx-1">{total}</span>
                    </span>
                    <span>اطلب الان</span>
                </div>
            </div>
            : undefined}
        </>
    );
}

export default ResponsiveCart;
