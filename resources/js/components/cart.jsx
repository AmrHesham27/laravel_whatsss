import React from "react";
import empty_cart_image from "../../../public/assets/img/empty-cart.svg";
import { useSelector } from "react-redux";
import CartItem from "./cartItem";

function Cart() {
    const cart = useSelector((state) => state.cart);

    const color_1 = localStorage.getItem('color_1');
    const color_2 = localStorage.getItem('color_2');
    const currency = localStorage.getItem('currency');
    
    return (
        <div className="cart">
            <div
                className="header cart-header"
                style={{ backgroundColor: color_1 }}
            >
                سلة مشترياتك
            </div>

            <div className="box">
                {!cart.itemsCount && (
                    <div
                        className="d-flex flex-column align-items-center empty pa-3"
                        style={{
                            padding: "15px",
                            backgroundColor: "rgb(246, 246, 246)",
                        }}
                    >
                        <img src={empty_cart_image} style={{ width: "80px" }} />
                        <p className="my-3 font-weight-bold">
                            لا يوجد أصناف في سلة المشتريات
                        </p>
                    </div>
                )}

                {cart.itemsCount > 0 && (
                    <>
                        {Object.values(cart.items).map((item) => (
                            <CartItem key={item.name} name={item.name} />
                        ))}
                        <div className="cart-info">
                            <div>
                                <span>السعر</span>
                                <div className="d-flex flex-row-reverse">
                                    <span className="mx-1">{currency}</span>

                                    <span>{cart.total}</span>
                                </div>
                            </div>
                        </div>
                        <div
                            className="order-now"
                            data-toggle="modal"
                            data-target="#send-to-whatsapp"
                        >
                            <button style={{ backgroundColor: color_2 }}>اطلب الان</button>
                        </div>
                    </>
                )}
            </div>
        </div>
    );
}

export default Cart;
