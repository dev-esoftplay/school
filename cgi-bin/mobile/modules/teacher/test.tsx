// withHooks

import React, { useEffect } from 'react';
import { View, Text, TouchableOpacity, StyleSheet, Image, Pressable } from 'react-native';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';

export interface TeacherTestArgs {}
export interface TeacherTestProps {}

const TeacherTest: React.FC<TeacherTestProps> = () => {


  const openTeacherScan = () => {
    LibNavigation.navigate('teacher/scan');
  };

  return (
    <View style={styles.container}>
      
      <Text style={styles.title}>Selamat Datang!</Text>
      <Text style={styles.subtitle}>Ayo mulai proses pembelajaran Anda!</Text>
      {/* Tombol untuk membuka TeacherScan */}
      <Pressable style={styles.button} onPress={()=>LibNavigation.navigate('utils/botnav')}>
        <Text style={styles.buttonText}>Buka TeacherScan</Text>
      </Pressable>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#ffffff',
  },
  logo: {
    width: 150,
    height: 150,
    marginBottom: 20,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 10,
  },
  subtitle: {
    fontSize: 16,
    color: '#888888',
    marginBottom: 20,
  },
  button: {
    backgroundColor: '#3498db',
    paddingVertical: 10,
    paddingHorizontal: 20,
    borderRadius: 8,
  },
  buttonText: {
    color: '#ffffff',
    fontSize: 18,
    fontWeight: 'bold',
  },
});

export default TeacherTest;