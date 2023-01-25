import React from "react";
import { useSelector, useDispatch } from "react-redux";
import { modalsActions } from "../redux/modals";

function ResponsiveCart() {
    const { total } = useSelector((state) => state.cart);

    const color_1 = localStorage.getItem('color_1');
    const currency = localStorage.getItem('currency');

    const dispatch = useDispatch();

    return (
        <>
            {
            total ?
            <div
                className="responsive-cart"
                style={{ backgroundColor: color_1 }}
                onClick={ () => dispatch(modalsActions.toggleCartModal()) }
            >
                <div className="d-flex">
                    <span className="d-flex flex-row mx-2">
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
