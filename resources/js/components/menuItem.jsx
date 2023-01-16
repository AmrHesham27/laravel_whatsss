import React from "react";
import { useDispatch } from "react-redux";
import { cartActions } from "../redux/cart";

function menuItem({ product, currency, color_2 }) {
    const dispatch = useDispatch();

    const addTocart = () => {
        dispatch(cartActions.addProduct(product));
    };

    return (
        <div className="menu-item">
            <div className="d-flex">
                <div style={{ textAlign: "end" }} className="mx-2">
                    <p className="f-15 font-weight-bold">{product["name"]}</p>
                    <p className="f-12">{product["desc"]}</p>
                </div>

                <img
                    src={`/products_images/${product["image"]}`}
                    alt="product"
                />
            </div>

            <div className="d-flex">
                <div
                    id={`add_buton_${product["id"]}`}
                    className="d-flex flex-column justify-content-center add-button"
                    onClick={addTocart}
                    style={{ backgroundColor: color_2 }}
                >
                    <i className="fa fa-plus" style={{ color: "white" }}></i>
                </div>
                <div className="d-flex flex-row-reverse align-items-center mx-4">
                    <span className="mx-1">{currency}</span>
                    <span>{product["price"]}</span>
                </div>
            </div>
        </div>
    );
}

export default menuItem;
