import { useSelector, useDispatch } from "react-redux";
import { cartActions } from "../redux/cart";
import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faMinus, faPlus } from "@fortawesome/free-solid-svg-icons";

const CartItem = ({ name }) => {
    const cart = useSelector((state) => state.cart);
    const dispatch = useDispatch();

    const color_1 = localStorage.getItem('color_1');

    return (
        <div className="cartItem p-2">
            <div className="controls">
                <button
                    style={{ color: color_1 }}
                    onClick={() =>
                        dispatch(cartActions.decreaseProductQty(name))
                    }
                >
                    <FontAwesomeIcon icon={faMinus} size={"1x"} />
                </button>
                <span className="p-2">{cart["items"][name]["qty"]}</span>
                <button
                    style={{ color: color_1 }}
                    onClick={() =>
                        dispatch(cartActions.increaseProductQty(name))
                    }
                >
                    <FontAwesomeIcon icon={faPlus} size={"1x"} />
                </button>
            </div>
            <span className="item-name">{cart["items"][name]["name"]}</span>
            <span className="price">
                {cart["items"][name]["price"] * cart["items"][name]["qty"]}
            </span>
            <span
                className="remove-item"
                onClick={() => dispatch(cartActions.removeProduct(name))}
            >
                <FontAwesomeIcon icon={faMinus} size={"1x"} />
            </span>
        </div>
    );
};

export default CartItem;
