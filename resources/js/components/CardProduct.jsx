import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCartShopping } from "@fortawesome/free-solid-svg-icons";
import { useDispatch } from "react-redux";
import { cartActions } from "../redux/cart";

const CardProduct = () => {
    const dispatch = useDispatch();

    const addTocart = () => {
        dispatch(cartActions.addProduct(product));
    };

    const color_1 = localStorage.getItem('color_1');
    const currency = localStorage.getItem('currency');

    return (
        <div className="d-flex flex-column card-product">
            <img
                src={`/images/${product["image"]}`}
                className="w-100"
            />
            <h5 className="mt-2">{product["name"]}</h5>
            <h6>{`${product["price"]} ${currency}`}</h6>
            <p>{product["desc"]}</p>
            <button
                className="w-100 p-2 mt-2"
                style={{ backgroundColor: color_1 }}
                onClick={addTocart}
            >
                <FontAwesomeIcon icon={faCartShopping} />
            </button>
        </div>
    );
};

export default CardProduct;
