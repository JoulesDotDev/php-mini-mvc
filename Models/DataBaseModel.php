<?php

abstract class DatabaseModel {
    private static function get_table_name() {
        throw new Exception("Not implemented");
    }

    private function save() {
        throw new Exception("Not implemented");
    }

    private function get_by_id($id) {
        throw new Exception("Not implemented");
    }

    private function get_all() {
        throw new Exception("Not implemented");
    }

    private function update($id, $data) {
        throw new Exception("Not implemented");
    }

    private function delete($id) {
        throw new Exception("Not implemented");
    }
}