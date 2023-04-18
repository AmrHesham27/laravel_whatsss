import React from "react";
import { useSelector, useDispatch } from "react-redux";
import { modalsActions } from "../redux/modals";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCartShopping } from "@fortawesome/free-solid-svg-icons";

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
                style={{ '--color1': color_1 }}
                onClick={ () => dispatch(modalsActions.toggleCartModal()) }
            >
                <div className="d-flex">
                    <FontAwesomeIcon icon={faCartShopping} />
                    <span className="d-flex flex-row ms-4">
                        <span>{currency}</span>
                        <span className="mx-1 fw-bolder">{total}</span>
                        <span className="mx-1">اطلب الآن</span>
                    </span>
                </div>
            </div>
            : undefined}
        </>
    );
}

export default ResponsiveCart;
