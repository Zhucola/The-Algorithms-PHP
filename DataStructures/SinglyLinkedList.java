public class SinglyLinkedList {
    private Node head;
    private int count;
    public void insertHead(int x) {
        Node newNode = new Node(x);
        newNode.next = head;
        head = newNode;
        ++count;
    }
    public void insertNth(int data,int position){
        if (position < 0 || position > count) {
            throw new RuntimeException("position less than zero or position more than the count of list");
        }else if(position == 0){
            insertHead(data);
        }else{
            Node node = new Node(data);
            Node tmp = head;
            for(int i = 0;i<position-1;i++){
                tmp = tmp.next;
            }
            node.next = tmp.next;
            tmp.next = node;
        }
        count++;
    }
    public Node deleteHead() {
        if (isEmpty()) {
            throw new RuntimeException("The list is empty!");
        }
        Node temp = head;
        head = head.next;
        --count;
        return temp;
    }
    public boolean isEmpty() {
        return count == 0;
    }
    public void display() {
        Node current = head;
        while (current != null) {
            System.out.print(current.value + " ");
            current = current.next;
        }
        System.out.println();
    }
    public static void main(String args[]) {
        SinglyLinkedList myList = new SinglyLinkedList();
        assert myList.isEmpty();
        myList.insertHead(5);
        myList.insertHead(7);
    }
}
class Node {
    public int value;
    public Node next;
    public Node(int value) {
        this.value = value;
    }
}
