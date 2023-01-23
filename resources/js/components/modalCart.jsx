import React from "react";
import { useSelector } from "react-redux";
import { CartItem } from './index';

function ModalCart() {
    const cart = useSelector((state) => state.cart);

    const color_1 = localStorage.getItem('color_1');
    const color_2 = localStorage.getItem('color_2');
    const currency = localStorage.getItem('currency');
    
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
                            style={{ color: color_1 }}
                        >
                            سلة مشترياتك
                        </div>
                    </div>
                    <div className="modal-body text-right">
                        {cart["itemsCount"] &&
                            Object.values(cart["items"]).map((item) => (
                                <CartItem key={item.name} name={item.name} />
                            ))}

                        <div className="cart-info">
                            <div>
                                <span>السعر</span>
                                <div className="d-flex flex-row-reverse">
                                    <span>{cart.total}</span>
                                    <span className="mx-1">{currency}</span>
                                </div>
                            </div>
                        </div>
                        <div
                            className="order-now"
                            data-toggle="modal"
                            data-target="#send-to-whatsapp"
                            data-dismiss="modal"
                            
                        >
                            <button style={{backgroundColor: color_2}}>اطلب الان</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default ModalCart;
