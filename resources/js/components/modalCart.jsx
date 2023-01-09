import React from "react";
import { useSelector } from "react-redux";
import CartItem from "./cartItem";

function ModalCart({ delivery_fees, color }) {
    const cart = useSelector((state) => state.cart);

    return (
        <div
            className="modal fade modal-cart"
            id="modal-cart"
            tabIndex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div className="modal-dialog" role="document">
                <div className="modal-content">
                    <div className="modal-header d-flex justify-content-between w-100">
                        <button
                            type="button"
                            className="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            style={{ padding: "0", margin: "0" }}
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div
                            className="modal-cart-header"
                            style={{ color: color }}
                        >
                            سلة مشترياتك
                        </div>
                    </div>
                    <div className="modal-body text-right">
                        {cart["itemsCount"] &&
                            Object.values(cart["items"]).map((item) => (
                                <CartItem key={item.name} name={item.name} color={color} />
                            ))}

                        <div className="cart-info">
                            <div>
                                <span>السعر</span>
                                <div className="d-flex flex-row-reverse">
                                    <span>{cart.total}</span>
                                    <span className="mx-1">ج.م</span>
                                </div>
                            </div>
                            <div>
                                <span>رسوم التوصيل</span>
                                <div className="d-flex flex-row-reverse">
                                    <span>{delivery_fees}</span>
                                    <span className="mx-1">ج.م</span>
                                </div>
                            </div>
                            <div className="fw-bold">
                                <span>الاجمالي</span>
                                <div className="d-flex flex-row-reverse">
                                    <span>{cart?.total + delivery_fees}</span>
                                    <span className="mx-1">ج.م</span>
                                </div>
                            </div>
                        </div>
                        <div
                            className="order-now"
                            data-toggle="modal"
                            data-target="#send-to-whatsapp"
                            data-dismiss="modal"
                        >
                            <button>اطلب الان</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default ModalCart;
