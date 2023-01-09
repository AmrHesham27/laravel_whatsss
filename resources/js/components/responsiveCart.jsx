import React from "react";
import { useSelector } from "react-redux";

function responsiveCart({color}) {
    const { total } = useSelector((state) => state.cart);

    return (
        <>
            {
            total ?
            <div
                className="responsive-cart"
                data-toggle="modal"
                data-target="#modal-cart"
                style={{ backgroundColor: color }}
            >
                <div className="d-flex">
                    <span className="d-flex flex-row-reverse mx-2">
                        <span className="mx-1">{total}</span>
                        <span>ج.م</span>
                    </span>
                    <span>اطلب الان</span>
                </div>
            </div>
            : undefined}
        </>
    );
}

export default responsiveCart;
