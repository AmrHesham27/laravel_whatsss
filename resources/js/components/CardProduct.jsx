import React, { useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCartShopping } from "@fortawesome/free-solid-svg-icons";
import { useDispatch } from "react-redux";
import { cartActions } from "../redux/cart";
import Modal from "react-bootstrap/Modal";
import Button from "react-bootstrap/Button";

const CardProduct = ({ product }) => {
    const color_1 = localStorage.getItem('color_1');
    const color_2 = localStorage.getItem('color_2');
    const currency = localStorage.getItem('currency');

    const dispatch = useDispatch();

    const addTocart = () => {
        dispatch(cartActions.addProduct(product));
    };

    const [modalShow, setModalShow] = useState(false);

    function ImageModal(props) {
        return (
            <Modal
                {...props}
                size="lg"
                aria-labelledby="contained-modal-title-vcenter"
                centered
            >
                <Modal.Body style={{ padding: '0', display: 'flex', justifyContent: 'center' }}>
                    <img
                        style={{ maxWidth: '100vw', maxHeight: 'calc(100vh - 71px)' }}
                        src={`/images/${product["image"]}`} alt="product"
                    />
                </Modal.Body>
                <Modal.Footer style={{ display: 'flex', justifyContent: 'center' }}>
                    <Button style={{ backgroundColor: color_2 }} onClick={props.onHide}>إغلاق</Button>
                </Modal.Footer>
            </Modal>
        );
    }

    return (
        <div className="d-flex flex-column card-product">
            <img
                src={`/images/${product["image"]}`}
                className="w-100"
                onClick={() => setModalShow(true)}
                style={{ cursor: 'pointer' }}
            />
            <p style={{textAlign: 'right', paddingRight: '10px'}} className="mt-2 card-product-title text-right">{product["name"]}</p>

            <p style={{textAlign: 'right', paddingRight: '10px'}}>{product["desc"]}</p>
            <button
                className="w-100 p-2 mt-2 add-cart-button"
                style={{ backgroundColor: color_1 }}
                onClick={addTocart}
            >
                <FontAwesomeIcon icon={faCartShopping} />
                <div className="d-flex justify-content-center">
                    <div className="mx-1">{currency}</div>
                    <div className="fw-bold">{product['price']}</div>
                </div>
            </button>

            <ImageModal
                show={modalShow}
                onHide={() => setModalShow(false)}
            />
        </div>
    );
};

export default CardProduct;
