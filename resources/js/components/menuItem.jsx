import React, { useState } from "react";
import { useDispatch } from "react-redux";
import { cartActions } from "../redux/cart";
import Modal from "react-bootstrap/Modal";
import Button from "react-bootstrap/Button";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPlus } from "@fortawesome/free-solid-svg-icons";

function MenuItem({ product }) {
    const dispatch = useDispatch();

    const addTocart = () => {
        dispatch(cartActions.addProduct(product));
    };

    const [modalShow, setModalShow] = useState(false);

    const color_2 = localStorage.getItem('color_2');

    function ImageModal(props) {
        return (
            <Modal
                {...props}
                size="lg"
                aria-labelledby="contained-modal-title-vcenter"
                centered
            >
                <Modal.Body style={{padding: '0', display: 'flex', justifyContent: 'center'}}>
                    <img 
                        style={{maxWidth: '100vw', maxHeight: 'calc(100vh - 71px)'}} 
                        src={`/images/${product["image"]}`} alt="product" 
                    />
                </Modal.Body>
                <Modal.Footer style={{display: 'flex', justifyContent: 'center'}}>
                    <Button style={{backgroundColor: color_2}} onClick={props.onHide}>إغلاق</Button>
                </Modal.Footer>
            </Modal>
        );
    }

    const currency = localStorage.getItem('currency');

    return (
        <div className="menu-item">
            <div className="d-flex">
                <div style={{ textAlign: "end" }} className="mx-2">
                    <p className="f-15 font-weight-bold">{product["name"]}</p>
                    <p className="f-12">{product["desc"]}</p>
                </div>

                <img src={`/images/${product["image"]}`} alt="product" onClick={() => setModalShow(true)} />
            </div>

            <div className="d-flex">
                <div
                    id={`add_buton_${product["id"]}`}
                    className="d-flex flex-column justify-content-center add-button"
                    onClick={addTocart}
                    style={{ backgroundColor: color_2 }}
                >
                    <FontAwesomeIcon
                        icon={faPlus}
                        size={"1x"}
                        style={{ color: "white" }}
                    />
                </div>
                <div className="d-flex flex-row align-items-center mx-4">
                    <span className="mx-1">{currency}</span>
                    <span>{product["price"]}</span>
                </div>
            </div>

            <ImageModal
                show={modalShow}
                onHide={() => setModalShow(false)}
            />
        </div>
    );
}

export default MenuItem;
