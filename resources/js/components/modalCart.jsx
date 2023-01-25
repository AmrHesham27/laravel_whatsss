import React from "react";
import { useSelector, useDispatch } from "react-redux";
import { CartItem } from "./index";
import { modalsActions } from "../redux/modals";
import Modal from "react-bootstrap/Modal";
import { useEffect } from "react";

function ModalCart() {
    const cart = useSelector((state) => state.cart);

    const color_1 = localStorage.getItem("color_1");
    const color_2 = localStorage.getItem("color_2");
    const currency = localStorage.getItem("currency");

    const dispatch = useDispatch();
    const modals = useSelector((state) => state.modals);

    useEffect(() => {
        if(modals.cartModal && !cart.itemsCount) dispatch(modalsActions.toggleCartModal())
    }, [modals, cart, dispatch])

    return (
        <Modal
            size="lg"
            aria-labelledby="contained-modal-title-vcenter"
            centered
            show={modals.cartModal}
            onHide={() => dispatch(modalsActions.toggleCartModal())}
        >
            <Modal.Header
                closeButton
                className="d-flex flex-row-reverse justify-content-between send-whatsapp-header"
            >
                <div className="modal-cart-header" style={{ color: color_1 }}>
                    سلة مشترياتك
                </div>
            </Modal.Header>

            <Modal.Body className="tex-right">
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
                    onClick={() =>
                        dispatch(modalsActions.toggleSendToWhatsapp())
                    }
                >
                    <button style={{ backgroundColor: color_2 }}>
                        اطلب الان
                    </button>
                </div>
            </Modal.Body>
        </Modal>
    );
}

export default ModalCart;
